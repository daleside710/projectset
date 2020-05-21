<?php

namespace App\Http\Controllers\Backend;

use Auth;
use DB;
use App\Http\Controllers\Controller;
use App\Models\BoxProduct;
use App\Models\Product;
use App\Models\Box;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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

    public function search(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        try {
            $products = Product::where('name', 'LIKE', '%' . $request->name . '%')
                ->get();

            return response()->json([
                'status' => true,
                'data' => $products
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function disable(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required'
        ]);

        try {
            $product = Product::find($request->product_id);
            $product->disabled = 1;
            $product->save();

            return response()->json([
                'status' => true,
                'data' => $product
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function enable(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required'
        ]);

        try {
            $product = Product::find($request->product_id);
            $product->disabled = 0;
            $product->save();

            return response()->json([
                'status' => true,
                'data' => $product
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(10);

        return view('backend.pages.products.index', compact('products'));
    }

    public function create()
    {
        return view('backend.pages.products.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'sell_back_price' => 'required',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20000'
        ]);

        try {
            //$image_path = imageUpload($request->image, 'images/products');
            $image_path = 'a';

            Product::create([
                'name' => $request->name,
                'sell_back_price' => $request->sell_back_price,
                'delivery_fee' => $request->delivery_fee,
                'image_path' => $image_path,
                'sizes' => ($request->sizes != null || $request->sizes != '') ? implode(',', $request->sizes) : null,
                'colors' => ($request->colors != null || $request->colors != '') ? implode(',', $request->colors) : null
            ]);

            return redirect()->back()->with('success', 'New product created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    public function edit($productID)
    {
        $product = Product::find($productID);

        return view('backend.pages.products.edit', compact('product'));
    }

    public function update(Request $request, $productID)
    {
        $this->validate($request, [
            'name' => 'required',
            'sell_back_price' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20000'
        ]);

        try {
            $product = Product::find($productID);

            $product->name = $request->name;

            if ($request->sizes != null || $request->sizes != '') {
                $product->sizes = implode(',', $request->sizes);
            } else {
                $product->sizes = null;
            }

            if ($request->colors != null || $request->colors != '') {
                $product->colors = implode(',', $request->colors);
            } else {
                $product->colors = null;
            }

            $product->sell_back_price = $request->sell_back_price;
            $product->delivery_fee = $request->delivery_fee;

            if ($request->hasFile('image')) {
                $image_path = imageUpload($request->image, 'images/products');
                
                if (Storage::disk('s3')->exists($product->image_path)) {
                    Storage::disk('s3')->delete($product->image_path);
                }

                $product->image_path = $image_path;
            }
            
            $product->save();

            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    public function destroy($productID)
    {
        try {
            BoxProduct::where('product_id', $productID)->delete();
            $product = Product::find($productID);

            if (Storage::disk('s3')->exists($product->image_path)) {
                Storage::disk('s3')->delete($product->image_path);
            }

            $product->delete();

            return redirect()->back()->with('success', 'Product deleted successfully.');

        } catch (\Exception $e) {

            return redirect()->back()->with('danger', $e->getMessage());

        }
    }
}
