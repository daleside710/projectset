<?php

namespace App\Http\Controllers\Backend;

use Auth;
use ImageOptimizer;
use App\Models\Box;
use App\Models\BoxProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoxController extends Controller
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

    public function index()
    {
        $boxes = Box::paginate(20);
        return view('backend.pages.boxes.index', compact('boxes'));
    }

    public function create()
    {
        return view('backend.pages.boxes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'box_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20000',
            'is_published' => 'required',
            'products' => 'required',
        ],[
            'products.required' => 'You have to add at least one product to the box.',
        ]);

        try {
            $image_path = imageUpload($request->box_image, 'images/boxes');

            $box_id = Box::insertGetId([
                'name' => $request->name,
                'is_published' => $request->is_published,
                'price' => $request->price * 100,
                'image_path' => $image_path,
            ]);

            foreach ($request->products as $key => $value) {
                BoxProduct::insert([
                    'box_id' => $box_id,
                    'product_id' => $key,
                    'wining_chance' => $value['wining_chance'],
                ]);
            }

            return redirect()->back()->with('success', 'New eBox created successfully.');
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function show()
    {
        return view('backend.pages.boxes.show');
    }

    public function edit($boxID)
    {
        $box = Box::find($boxID);
        
        if (!$box) {
            return redirect()->route('admin.boxes.index')->with('warning', 'Invalid box.');
        }

        return view('backend.pages.boxes.edit', compact('box'));
    }

    public function update(Request $request, $boxID)
    {
        try {

            $box = Box::find($boxID);

            if (!$box) {
                return redirect()->route('admin.boxes.index')->with('warning', 'Invalid box.');
            }

            $box->name = $request->name;
            $box->is_published = $request->is_published;
            $box->price = $request->price * 100;

            if ($request->hasFile('box_image')) {
                $image_path = imageUpload($request->box_image, 'images/boxes');
                $box->image_path = $image_path;
            }
            
            $box->save();

            $postProducts = (array) $request->products;
            $oldItems =  $box->box_products->pluck('product_id')->toArray();
            $newItems = [];
            foreach ($postProducts as $key => $value) {
                array_push($newItems, $key);
            }

            // array_diff($newItems, $oldItems); // New Items


            foreach ($request->products as $key => $value) {
                BoxProduct::updateOrCreate([
                        'box_id' => $boxID,
                        'product_id' => $key
                    ],[
                        'box_id' => $boxID,
                        'product_id' => $key,
                        'wining_chance' => $value['wining_chance']
                ]);
            }

             // Deleting Removed Items
            foreach (array_diff($oldItems, $newItems) as $productID) {
                BoxProduct::where('box_id', $boxID)
                    ->where('product_id', $productID)
                    ->delete();
            }

            return redirect()->back()->with('success', 'eBox updated successfully.');
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function destroy($boxID)
    {
        try {

            $box = Box::find($boxID);

            if (!$box) {
                return redirect()->route('admin.boxes.index')->with('warning', 'Invalid box.');
            }

            BoxProduct::where('box_id', $boxID)->delete();

            if (Storage::disk('s3')->exists($box->image_path)) {
                Storage::disk('s3')->delete($box->image_path);
            }

            $box->delete();

            return redirect()->back()->with('success', 'Ebox deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
}
