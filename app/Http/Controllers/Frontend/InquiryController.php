<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Mail\InquiryMessage;
use Mail;
use Exception;


class InquiryController extends Controller
{
    public function index(Request $request) : JsonResponse
    {
        try {
            $name = $request->input('name');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $product = $request->input('product_title');
            $brand = $request->input('product_brand');
            $quantity = $request->input('quantity');
            $location = $request->input('delivery_location');
            $gmail = 'test.tushar.dev@gmail.com';

            Mail::to($gmail)->send(new InquiryMessage($name, $phone, $email, $product, $brand, $quantity, $location));
            return response()->json([
                'status' => 'success',
                'message' => 'Inquiry Sent Successfully!',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send inquiry. Please try again later. ' . $e,
            ], 500);
        }
    }
}
