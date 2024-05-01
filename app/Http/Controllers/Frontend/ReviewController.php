<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::query()->with('product');

        if (\request()->has('onlyData')){
            return response()->json($reviews->get(), 200);
        }else{
            $reviews = $reviews->paginate(10)->withQueryString();
            return response()->json($reviews, 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required',
            'rating' => 'required',
            'review' => 'required',
        ]);
        $data['user_id'] = Auth::user()->id;
        $data['name'] = Auth::user()->name;
        $data['email'] = Auth::user()->email;
        Review::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($productId)
    {
        $totalRating  = Review::query()->where('product_id', $productId)->sum('rating');
        $reviews = Review::query()->where('product_id', $productId)->get();



        return response()->json([
            'reviews' => $reviews,
            'totalRating' => $totalRating,
            'average' => $totalRating / $reviews->count(),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return response('Review Delete Successfully Done...');
    }
}
