<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::all();

        return response()->json([
            'data' => $vouchers
        ], 200);
    }
    
    public function show(Request $request, $voucher_id)
    {
        
        $voucher = Voucher::find($voucher_id);

        if (!$voucher) {
            return response()->json([
                'message' => 'Voucher not found'
            ], 404);
        }

        return response()->json([
            'data' => $voucher,
            'valid' => $voucher->isValid() ? 'Voucher is valid' : 'Voucher has expired'
        ], 200);
    }

    public function store(Request $request)
    {

        $validation = Validator::make(
            $request->all(),
            [
                "user_id" => "required|integer",
                "title" => "required|string|max:255",
                "amount" => "required|numeric",
                "expires_at" => "required|date"
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validation->errors()
            ], 400);
        }

        $voucher = new Voucher();
        $voucher->user_id = $request->user_id;
        $voucher->title = $request->title;
        $voucher->amount = $request->amount;
        $voucher->expires_at = $request->expires_at;
        $voucher->save();

        return response()->json([
            'message' => 'Voucher created successfully',
            'voucher' => $voucher
        ], 201);
    }
}
