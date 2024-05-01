<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class FrontendProductController extends Controller
{

    public function searchProduct(Request $request)
    {
        $data = Product::query()
            ->with('images')
            ->when($request->input('query'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('query') . '%')
                ->orderBy('title');
            })
            ->get();

        return response()->json($data);
    }
    public function allProducts(Request $request)
    {
        return inertia('Frontend/Products', [
            'brands' => Brand::latest()->get(),
            'categories' => Category::latest()->get(),
            'products' => Product::query()
                            ->with('category', 'images', 'brand')

                            ->when($request->input('query'), function ($query) use ($request) {
                                $query->where('title', 'like', '%' . $request->input('query') . '%')
                                ->orderBy('title');
                            })
                            ->when($request->input("category_id"), function ($query) use ($request) {
                                $query->where('category_id', $request->input('category_id'));
                            })
                            ->when($request->input("brand_id"), function ($query) use ($request) {
                                $query->where('brand_id', $request->input('brand_id'));
                            })
                            ->get()

        ]);
    }

    public function getTitle()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function getBrands()
    {
        $brands = Brand::all();
        return response()->json($brands);
    }

    public function getCategories()
    {
        $categories = Category::all();
        return response()->json($categories);

    }

    public function productDetail($slug) {
        $product = Product::where('slug', $slug)
            ->withCount('reviews')
            ->withSum('reviews', 'rating')
            ->first();

        $totalReviews = $product->reviews_count;
        $totalRatings = $product->reviews_sum_rating;
        $averageRating = $totalReviews > 0 ? $totalRatings / $totalReviews : 0;


        return inertia('Frontend/ProductDetail', [
            'product' => Product::where('slug', $slug)->with('images', 'category', 'brand', 'questions', 'questions.user', 'reviews', 'reviews.user')->first(),
            'ProductAverageRating' => $averageRating
        ]);
    }
}
