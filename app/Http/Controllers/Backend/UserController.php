<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;

use Auth;
use DB;

use App\Models\User;
use App\Models\BoxOpen;
use App\Models\Order;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            if (Auth::user()->type === 1) {
                return redirect()->route('home')->with('warning', 'Denne siden er kun forbeholdt ledelsen.');
            }
            return $next($request);
        });
    }

    public function index(Request $req)
    {
        $key = trim( $req->input('key') );

        if( $key ){
            $users = User::where('name', 'like', "%{$key}%")
                ->orWhere('email', 'like', "%{$key}%")
                ->orderBy('id', 'DESC')
                ->paginate(10)
                ->appends($req->except('page'));
        } else {
            $users = User::orderBy('id', 'DESC')
                ->paginate(10);
        }

        return view('backend.pages.users.index', compact('users', 'key'));
    }

    public function create()
    {
        return view('backend.pages.users.create');
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20000'
        ]);

        try {
            $user = new User;

            $user->type = $req->input('type');
            $user->name = $req->input('name');
            $user->email = $req->input('email');
            $user->phone = $req->input('phone');
            $user->city = $req->input('city');
            $user->address = $req->input('address');
            $user->zip_code = $req->input('zip_code');
            $user->uuid = $req->input('uuid');

            $user->password = Hash::make( $req->input('password') );

            if ($req->hasFile('image')) {
                $image_path = imageUpload($req->image, 'images/avatars');

                if (Storage::disk('s3')->exists($user->image_path)) {
                    Storage::disk('s3')->delete($user->image_path);
                }

                $user->image_path = $image_path;
            }

            $user->save();

            return redirect()->back()->with('success', 'Ny bruker opprettet.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    public function edit($userID)
    {
        $user = User::find($userID);

        $info = array();
        $info['wallet_balance'] = number_format($user->balanceFloat, 2, ',', ' ');
        $info['total_deposits'] = number_format($user->transactions()->where('type', 'deposit')->sum('amount') / 100, 2, ',', ' ');
        $info['boxes_opened'] = BoxOpen::where('user_id', $userID)->count();
        $info['total_orders'] = Order::where('user_id', $userID)->count();

        return view('backend.pages.users.edit', compact('user', 'info'));
    }

    public function update(Request $req, $userID)
    {
        $this->validate($req, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20000'
        ]);

        try {
            $user = User::find($userID);

            $user->type = $req->input('type');
            $user->name = $req->input('name');
            $user->email = $req->input('email');
            $user->phone = $req->input('phone');
            $user->city = $req->input('city');
            $user->address = $req->input('address');
            $user->zip_code = $req->input('zip_code');
            $user->uuid = $req->input('uuid');

            if ($req->hasFile('image')) {
                $image_path = imageUpload($req->image, 'images/avatars');

                if (Storage::disk('s3')->exists($user->image_path)) {
                    Storage::disk('s3')->delete($user->image_path);
                }

                $user->image_path = $image_path;
            }

            $balance = doubleval( $req->input('balance') );

            if( $balance > $user->balanceFloat )
                $user->depositFloat( $balance - $user->balanceFloat );
            else if( $balance < $user->balanceFloat )
                $user->withdraw( ($user->balanceFloat - $balance) * 100 );

            $user->save();

            return redirect()->route('admin.users.index')->with('success', 'Brukeren ble oppdatert.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    public function destroy($userID)
    {
        try {
            $user = User::find($userID);

            if (Storage::disk('s3')->exists($user->image_path)) {
                Storage::disk('s3')->delete($user->image_path);
            }

            $user->delete();

            return redirect()->back()->with('success', 'Brukeren ble slettet.');

        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    /**
     * Ban User
     *
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ban(Request $req)
    {
        $this->validate($req, [
            'user_id' => 'required',
            'reason' => 'required'
        ]);

        try {
            $user = User::find( $req->user_id );
            $user->is_banned = 1;
            $user->banned_reason = $req->input('reason');
            $user->banned_at = date('Y-m-d H:i:s');
            $user->save();

            Order::where('user_id', $req->user_id)
                ->update( array('is_deleted' => 1, 'deleted_at' => date('Y-m-d H:i:s') ) );

            return response()->json([
                'status' => true,
                'data' => $user
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Permit(Unban) User
     *
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function permit(Request $req)
    {
        $this->validate($req, [
            'user_id' => 'required'
        ]);

        try {
            $user = User::find( $req->user_id );
            $user->is_banned = 0;
            $user->banned_reason = null;
            $user->banned_at = date('Y-m-d H:i:s');
            $user->save();

            Order::where('user_id', $req->user_id)
                ->update( array('is_deleted' => 0, 'deleted_at' => null ) );

            return response()->json([
                'status' => true,
                'data' => $user
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
