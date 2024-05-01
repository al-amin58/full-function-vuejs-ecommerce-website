<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        return inertia('Frontend/Index', [
        'brands'             =>     Brand::latest()->get(),
        'categories'        =>     Category::with('childrenRecursive')->where('parent_id', 0)->get(),
        'products'          =>     Product::with('images', 'category', 'brand')->latest()->get(),
        ]);
    }

    public function filterProducts(Request $request)
    {
        $products = Product::query()
            ->with('category', 'images', 'brand')
            ->when($request->input("category_id"), function ($query) use ($request) {
                $query->where('category_id', $request->input('category_id'));
            })
            ->when($request->input("brand_id"), function ($query) use ($request) {
                $query->where('brand_id', $request->input('brand_id'));
            })
            ->take(8)
            ->get();

        return response()->json($products);
    }

    public function showContactPage()
    {
        return inertia('Frontend/Contact');
    }

    public function showAboutPage()
    {
        return inertia('Frontend/About');
    }
}
