<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use DB;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Mail\SendFreeBoxMail;
use App\Notifications\SendNotification;
use App\Models\Box;
use App\Models\BoxOpen;
use App\Models\ContactEmail;
use App\Models\CouponCode;
use App\Models\CouponCodeUser;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\WonedProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Stripe\Charge as StripeCharge;
use Stripe\Stripe as StripeCore;

class PageController extends Controller
{
    public function initiateRedeem(Request $request)
    {
        $this->validate($request, [
            'boxID' => 'required'
        ]);

        $box = Box::find($request->boxID);

        $products = DB::table('box_products')
            ->join('products', 'box_products.product_id', '=', 'products.id')
            ->where('box_products.box_id', $request->boxID)
            ->get();

        $spinnerItems = [];
        $boxProducts = [];

        foreach ($products as $product) {
            array_push($boxProducts, [
                'product_id' => $product->id,
                'image_path' => asset($product->image_path),
                'name' => $product->name,
                'sell_back_price' => $product->sell_back_price
            ]);

            array_push($spinnerItems, [
                'background' => asset($product->image_path)
            ]);
        }

        $wonedItems = DB::table('woned_products')
            ->join('products', 'woned_products.product_id', '=', 'products.id')
            ->where('woned_products.user_id', auth()->user()->id)
            ->where('woned_products.status', 0)
            ->orderBy('woned_products.id', 'desc')
            ->get();

        foreach ($wonedItems as $p) {
            $p->image_path = asset($p->image_path);
        }

        $response = [
            'status' => true,
            'data' => [
                'wonedProducts' => $wonedItems,
                'boxProducts' => $boxProducts,
                'spinnerItems' => $spinnerItems
            ]
        ];

        return response()->json($response);
    }

    public function loadItems()
    {
        $wonedItems = DB::table('woned_products')
            ->join('products', 'woned_products.product_id', '=', 'products.id')
            ->where('woned_products.user_id', auth()->user()->id)
            ->where('woned_products.status', 0)
            ->orderBy('woned_products.id', 'desc')
            ->get();

        $view = view('frontend.pages.redeem.items', compact('wonedItems'))->render();
        return response()->json(['html' => $view]);
    }

    public function checkDiscountedCoupon(Request $request)
    {
        if ($request->has('coupon_code') && $request->has('boxID')) {
            $coupon = CouponCode::where(function ($query) use ($request) {
                    $query->whereCode($request->coupon_code);
                    $query->whereType('discountedspin');
                    $query->whereDate("valid_from", '<=', date("Y-m-d"));
                    $query->whereDate("valid_to", '>', date("Y-m-d"));
                    $query->whereNull('user_id');
                    $query->whereBoxId($request->boxID);
                })
                ->orWhere(function ($query) use ($request) {
                    $query->whereUserId(auth()->id());
                    $query->whereCode($request->coupon_code);
                    $query->whereType('deposit');
                    $query->whereDate("valid_from", '<=', date("Y-m-d"));
                    $query->whereDate("valid_to", '>', date("Y-m-d"));
                    $query->whereBoxId($request->boxID);
                })
                ->first();

            if ($coupon) {
                $count = CouponCodeUser::whereUserId(auth()->id())->whereCouponId($coupon->id)->count();
                if ($count < $coupon->no_of_use) {
                    $response = [
                        'status' => true,
                        'message' => 'Kupongkode gyldig.'
                    ];
                } else {
                    $response = [
                        'status' => false,
                        'message' => 'Denne kupongkoden er ikke gyldig lenger.'
                    ];
                }
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Ugyldig kupongkode.'
                ];
            }
        } else {
            $response = [
                'status' => false,
                'message' => 'En feil har oppstått.'
            ];
        }
        return response()->json($response);
    }


    public function checkBalance(Request $request)
    {
        $box = Box::find($request->boxID);
        if (auth()->user()->balance < $box->price) {
            return response()->json([
                'status' => false,
                'message' => 'Beløpet i lommeboken din er for lite. Vennligst gjør et innskudd.'
            ]);
        } else {
            return response()->json([
                'status' => true
            ]);
        }
    }


    public function spin(Request $request)
    {
        $this->validate($request, [
            'boxID' => 'required'
        ]);

        $box = Box::find($request->boxID);

        if ($box->type === 'free') {
            $boxIsTimeCompleted = \App\Models\BoxOpen::whereBoxId($box->id)
                ->whereIsOpened(0)
                ->whereUserId(auth()->user()->id)
                ->orderBy('id', 'desc')
                ->first();
            $diffInMinutes = null;
            if ($boxIsTimeCompleted) {
                $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $boxIsTimeCompleted->created_at);
                $to = \Carbon\Carbon::now();
                $diffInMinutes = $from->diffInMinutes($to);
                if ($diffInMinutes < 1440) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Den daglige boksen kan kun brukes en gang per dag.'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Du må åpne boksen først og fremst.'
                ]);
            }
        }

        if ($request->has('coupon_code')) {
            $coupon = CouponCode::whereCode($request->coupon_code)->whereBoxId($request->boxID)->first();

            $percentage = $box->price * $coupon->amount / 100;
            if (auth()->user()->balance < $box->price) {
                return response()->json([
                    'status' => false,
                    'message' => 'Beløpet i lommeboken din er for lite. Vennligst gjør et innskudd.'
                ]);
            }

            $weights = [];
            $products = [];

            $boxProducts = DB::table('box_products')
                ->join('products', 'box_products.product_id', '=', 'products.id')
                ->where('box_products.box_id', $request->boxID)
                ->where('products.disabled', 0)
                ->get();

            $i = 0;

            foreach ($boxProducts as $product) {
                array_push($products, ['index' => $i++, 'product_id' => $product->product_id]);
                array_push($weights, $product->wining_chance);
            }

            $box->price = intval($box->price - ($box->price * $coupon->amount / 100));
            auth()->user()->pay($box);
            CouponCodeUser::create([
                "user_id" => auth()->id(),
                "coupon_id" => $coupon->id,
                "code" => $coupon->code,
                "amount" => $coupon->amount
            ]);

        } else {
            if (auth()->user()->balance < $box->price) {
                return response()->json([
                    'status' => false,
                    'message' => 'Beløpet i lommeboken din er for lite. Vennligst gjør et innskudd.'
                ]);
            }

            $weights = [];
            $products = [];

            $boxProducts = DB::table('box_products')
                ->join('products', 'box_products.product_id', '=', 'products.id')
                ->where('box_products.box_id', $request->boxID)
                ->where('products.disabled', 0)
                ->get();

            $i = 0;

            foreach ($boxProducts as $product) {
                array_push($products, ['index' => $i++, 'product_id' => $product->product_id]);
                array_push($weights, $product->wining_chance);
            }
            auth()->user()->pay($box);

        }
        
        if ($box->type === "free") {
            $boxOpen = BoxOpen::whereBoxId($box->id)->whereUserId(auth()->id())->orderBy('id', 'DESC')->first();
            $boxOpen->is_opened = 1;
            $boxOpen->save();
        }

        $response = [
            'status' => true,
            'data' => [
                'balance' => auth()->user()->balanceFloat,
                'result' => $this->selectRadom($products, $weights)
            ]
        ];


        WonedProduct::create([
            'redeem_id' => uniqid(),
            'box_id' => $box->id,
            'product_id' => $response['data']['result']['product_id'],
            'user_id' => auth()->user()->id
        ]);

        return response()->json($response);
    }

    public function selectRadom($items, $weights)
    {
        $rel_weight = [];
        $probs = [];

        $totalWeight = (float)array_sum($weights);
        foreach ($weights as $w) {
            array_push($rel_weight, ($w / $totalWeight));
        }

        foreach ($rel_weight as $i => $value) {
            array_push($probs, array_sum(array_slice(array_reverse($rel_weight), $i)));
        }

        $probs = array_reverse($probs);
        $slot = mt_rand() / mt_getrandmax();

        foreach ($items as $i => $item) {
            if ($slot <= $probs[$i]) {
                break;
            }
        }

        return $item ?? null; // Returns array
    }


    public function sellBack(Request $request)
    {
        $this->validate($request, [
            'productID' => 'required',
        ]);

        $product = WonedProduct::where('product_id', $request->productID)
            ->where('user_id', auth()->user()->id)
            ->where('status', 0)
            ->first();

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Dette produktet er ikke i produktlisten din.'
            ]);
        }

        auth()->user()->deposit($product->product->sell_back_price);
        $product->status = 1;
        $product->save();

        return response()->json([
            'status' => true,
            'data' => [
                'balance' => auth()->user()->balanceFloat
            ]
        ]);
    }


    public function home()
    {
        if (auth()->check()) {
            $boxIsTimeCompleted = \App\Models\BoxOpen::whereIsOpened(0)->whereUserId(auth()->user()->id)->orderBy('id', 'desc')->first();

            if ($boxIsTimeCompleted) {
                $user = auth()->user();
                $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $boxIsTimeCompleted->created_at);
                $to = \Carbon\Carbon::now();
                $diffInMinutes = $from->diffInMinutes($to);
                if ($diffInMinutes >= 1440 && $boxIsTimeCompleted->is_notified != 1) {
                    if ($user->uuid) {
                        $user->notify(new SendNotification('Lykkeboks', 'Din daglige boks er klar til å bli åpnet :) ', url('/'), url('logo.png')));
                    }
                    Mail::to($user->email)->send(new SendFreeBoxMail($user->name, 'Din daglige boks er klar til å bli åpnet :)'));
                    $boxIsTimeCompleted->is_notified = 1;
                    $boxIsTimeCompleted->save();
                }
            }
        }
        
        $boxes = DB::table('boxes')
            ->where('is_published', 1)
            ->get();

        return view('frontend.pages.home.index', compact('boxes'));
    }

    public function boxDetails($boxID)
    {   
        $box = DB::table('boxes')->where('id', $boxID)->first();

        $boxProducts = DB::table('box_products')
            ->join('products', 'box_products.product_id', '=', 'products.id')
            ->where('box_products.box_id', $boxID)
            ->orderBy('products.sell_back_price', 'desc')// better way to implement this?
            ->get();

        return view('frontend.pages.box-details.index', compact('boxProducts', 'box'));
    }

    public function account()
    {
        $wonedItems = DB::table('woned_products')
            ->join('products', 'woned_products.product_id', '=', 'products.id')
            ->where('woned_products.user_id', auth()->user()->id)
            ->where('woned_products.status', 0)
            ->orderBy('woned_products.id', 'desc')
            ->get([
                'products.name',
                'products.image_path',
                'products.sell_back_price',
                'products.id as product_id',
            ]);

        $orders = Order::where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('frontend.pages.account.index', compact('wonedItems', 'orders'));
    }


    public function updateAccount(Request $request)
    {
        $this->validate($request, [
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            User::where('id', auth()->user()->id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'country' => $request->country,
                    'city' => $request->city,
                    'phone' => $request->phone,
                    'region' => $request->region,
                    'zip_code' => $request->zip_code,
                    'address' => $request->address,
                ]);

            if ($request->new_password) {
                User::where('id', auth()->user()->id)
                    ->update([
                        'password' => bcrypt($request->new_password)
                    ]);
            }

            if ($request->profile_image) {
                $image_path = imageUpload($request->profile_image, 'images/avatars');

                if (Storage::disk('s3')->exists(auth()->user()->image_path)) {
                    Storage::disk('s3')->delete(auth()->user()->image_path);
                }

                User::where('id', auth()->user()->id)
                    ->update([
                        'image_path' => $image_path
                    ]);
            }

            return redirect()->back()->with('success', 'Kontoen din har blitt oppdatert.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Noe gikk galt...' . $e->getMessage());
        }
    }


    public function deposit()
    {
        return view('frontend.pages.deposit.index');
    }

    public function checkout(Request $request)
    {
        try {
            StripeCore::setApiKey(env('STRIPE_SECRET'));

            $charge = StripeCharge::create([
                'amount' => $request->amount,
                'currency' => 'nok',
                'description' => 'Lykkeboks innskudd #' . $request->tokenID,
                'source' => $request->tokenID,
            ]);

            auth()->user()->deposit($request->amount);

            return response()->json([
                'status' => true,
                'message' => 'Innskudd vellykket!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function redeem($boxID)
    {
        if (auth()->user()->type === 2) {
            return redirect()->route('home')->with('warning', 'Moderatorer er ikke autorisert til å åpne bokser.');
        }

        $boxProducts = DB::table('box_products')
            ->join('products', 'box_products.product_id', '=', 'products.id')
            ->where('box_products.box_id', $boxID)
            ->where('products.disabled', 0)
            ->get();
        if( count( $boxProducts ) === 0 )
            return redirect()->back();

        $box = Box::find($boxID);

        $wonedItems = DB::table('woned_products')
            ->join('products', 'woned_products.product_id', '=', 'products.id')
            ->where('woned_products.user_id', auth()->user()->id)
            ->where('woned_products.status', 0)
            ->orderBy('woned_products.id', 'desc')
            ->get();

        $products = DB::table('box_products')
            ->join('products', 'box_products.product_id', '=', 'products.id')
            ->where('box_products.box_id', $boxID)
            ->get();

        $boxProducts = [];

        foreach ($products as $product) {
            array_push($boxProducts, [
                'product_id' => $product->id,
                'image_path' => asset($product->image_path),
                'name' => $product->name,
                'sell_back_price' => $product->sell_back_price
            ]);
        }

        /*Code added for to check user balance*/
        $user_balance = [];

        if (auth()->user()->balance < $box->price) {
            $user_balance = response()->json([
                'status' => false,
                'message' => 'Beløpet i lommeboken din er for lite. Vennligst gjør et innskudd.'
            ]);
        } else {
            $user_balance = response()->json([
                'status' => true
            ]);
        }

        return view('frontend.pages.redeem.index', compact('boxID', 'wonedItems', 'boxProducts', 'user_balance'));
    }

    public function getOrderAll()
    {
        $wins = WonedProduct::where('user_id', auth()->user()->id)
            ->where('status', 0)
            ->get();

        return view('frontend.pages.order.details', compact('wins'));
    }

    public function createOrder(Request $request)
    {
        try {
            Auth::user()->update([
                'country' => $request->country,
                'city' => $request->city,
                'phone' => $request->phone,
                'region' => $request->region,
                'zip_code' => $request->zip_code,
                'address' => $request->address
            ]);

            if ($request->delivery_fees > 0) {
                if ($request->delivery_fees > auth()->user()->balance) {
                    return redirect()->back()->with('danger', 'Beløpet i lommeboken din er for lite. Vennligst gjør et innskudd.');
                }
                auth()->user()->withdraw($request->delivery_fees);
            }

            $order = Order::create([
                'user_id' => auth()->user()->id,
                'status' => 0
            ]);

            foreach ($request->items as $winID => $winDetails) {
                $winDetails = (object)$winDetails;

                $wonedItem = WonedProduct::where('user_id', auth()->user()->id)
                    ->where('product_id', $winDetails->product_id)
                    ->where('status', 0)
                    ->first();

                if (!$wonedItem) {
                    $order->delete();
                    return redirect()->back()->with('danger', 'Dette produktet er ikke i produktlisten din.');
                }

                $newOrderDetail = new OrderDetail;
                $newOrderDetail->order_id = $order->id;
                $newOrderDetail->product_id = $winDetails->product_id;

                if (isset($winDetails->size)) {
                    $newOrderDetail->size = $winDetails->size;
                }

                if (isset($winDetails->color)) {
                    $newOrderDetail->color = $winDetails->color;
                }
                $newOrderDetail->save();

                $wonedItem->status = 1;
                $wonedItem->save();
            }

            return redirect()->route('home')->with('success', 'Din bestilling er mottatt. Du vil se bestillingsstatus på Min side.');

        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }


    public function orderItem($productID)
    {
        $wins = WonedProduct::where('user_id', auth()->user()->id)
            ->where('product_id', $productID)
            ->where('status', 0)
            ->get();

        return view('frontend.pages.order.details', compact('wins'));
    }


    public function applyCouponCode(Request $request)
    {
        if (!$request->has('coupon_code') && !$request->has('deposit')) {
            return response()->json([
                'status' => false,
                'message' => 'Ugyldig kupongkode.'
            ]);
        }

        try {
            DB::beginTransaction();

            $coupon = CouponCode::where(function ($query) use ($request) {
                    $query->whereCode($request->coupon_code);
                    $query->whereType($request->type);
                    $query->whereDate("valid_from", '<=', date("Y-m-d"));
                    $query->whereDate("valid_to", '>', date("Y-m-d"));
                    $query->whereNull('user_id');
                })
                ->orWhere(function ($query) use ($request) {
                    $query->whereUserId(auth()->id());
                    $query->whereCode($request->coupon_code);
                    $query->whereType($request->type);
                    $query->whereDate("valid_from", '<=', date("Y-m-d"));
                    $query->whereDate("valid_to", '>', date("Y-m-d"));
                })
                ->firstOrFail();

            if ($coupon) {
                $count = CouponCodeUser::whereUserId(auth()->id())->whereCouponId($coupon->id)->count();
                if ($count < $coupon->no_of_use) {
                    auth()->user()->deposit($coupon->amount);
                    CouponCodeUser::create([
                        "user_id" => auth()->id(),
                        "coupon_id" => $coupon->id,
                        "code" => $coupon->code,
                        "amount" => $coupon->amount
                    ]);
                    DB::commit();
                    return response()->json([
                        'status' => true,
                        'balance' => auth()->user()->balanceFloat,
                        'message' => 'Innskudd vellykket! Kupongkoden kan benyttes ' . $count . ' gang(er) igjen.'
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Denne kupongkoden har allerede blitt brukt opp.'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Ugyldig kupongkode.'
                ]);
            }

        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => 'En feil har oppstått.'
            ]);
        }
    }

    public function sendContactEmail(Request $request)
    {
        try {
            $email1 = $request->email;
            $content = $request->message;
            
            Mail::to("support@lykkeboks.no")->send(new ContactMail($email1, $content));
            ContactEmail::create(['email' => $email1, 'content' => $content, 'is_replied' => 0]);

            return response()->json(['success' => true, 'message' => 'E-post har blitt sendt! Du hører fra oss snart.']);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Noe gikk galt, prøv på nytt igjen senere.']);
        }
    }

    public function openBox($boxId)
    {
        try {
            $data = [
                'user_id' => auth()->id(),
                'box_id' => $boxId,
                'is_opened' => 0
            ];
            BoxOpen::create($data);
            session()->flash('success', 'Boksen har blitt låst opp og nedtelling har startet.');
        } catch (\Exception $ex) {
            session()->flash('danger', $ex->getMessage());
        }
        return redirect()->back();
    }

    public function getCurrentTime()
    {
        return response()->json(['datetime' => Carbon::now()->format('F d, Y H:i:s')]);
    }

    public function updateUserPushId(Request $request)
    {
        $user = auth()->user();
        $user->uuid = $request->userId;
        $user->save();
    }

    public function sendCurrentUser()
    {
        $user = auth()->user();
        if ($user->uuid) {
            $user->notify(new SendNotification('Lykkeboks', 'Din daglige boks er klar til å bli åpnet!', url('/'), url('logo.png')));
        }
        Mail::to($user->email)->send(new SendFreeBoxMail($user->name, 'Din daglige boks er klar til å bli åpnet!'));
        $boxOpen = \App\Models\BoxOpen::whereIsOpened(0)->whereUserId(auth()->user()->id)->orderBy('id', 'desc')->first();
        $boxOpen->is_notified = 1;
        $boxOpen->save();
        return response()->json(['success' => true]);
    }
}