<?php

namespace App\Http\Controllers\Backend;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\CouponCode;
use App\Models\User;
use Illuminate\Http\Request;

class CouponCodeController extends Controller
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
            'code' => 'required'
        ]);
        try {
            $couponCodes = CouponCode::where('code', 'LIKE', '%' . $request->code . '%')
                ->get();

            return response()->json([
                'status' => true,
                'data' => $couponCodes
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
        $couponCodes = CouponCode::orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.coupons.index', compact('couponCodes'));
    }

    public function create()
    {
        $users = User::all();
        $boxes = Box::all();
        return view('backend.pages.coupons.create', compact('users', 'boxes'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'type' => 'required',
            'valid_from' => 'required',
            'valid_to' => 'required'
        ]);

        try {
            CouponCode::create([
                'code' => $request->code,
                'type' => $request->type,
                'box_id' => $request->box_id,
                'user_id' => $request->user_id,
                'no_of_use' => $request->no_of_use,
                'amount' => $request->amount,
                'valid_from' => $request->valid_from,
                'valid_to' => $request->valid_to
            ]);
            return redirect()->back()->with('success', 'New Coupon created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    public function edit($couponCodeId)
    {
        $couponCode = CouponCode::whereId($couponCodeId)->firstOrFail();
        $users = User::all();
        $boxes = Box::all();
        return view('backend.pages.coupons.edit', compact('couponCode', 'users', 'boxes'));
    }

    public function update(Request $request, $couponCodeId)
    {
        $this->validate($request, [
            'code' => 'required',
            'type' => 'required',
            'valid_from' => 'required',
            'valid_to' => 'required'
        ]);
        try {
            $couponCode = CouponCode::find($couponCodeId);
            $couponCode->update($request->except('_token', '_method'));
            return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    public function destroy($couponCodeId)
    {
        try {
            $couponCode = CouponCode::find($couponCodeId);
            $couponCode->delete();
            return redirect()->back()->with('success', 'Coupon deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
}
