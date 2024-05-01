<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use App\Models\Purpose;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return inertia('dashboard/Index', [
            'products' => Product::all()->count(),
            'categories' => Category::all()->count(),
            'brands'=> Brand::all()->count()
        ]);
    }
}
