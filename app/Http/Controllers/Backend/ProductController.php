<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return inertia('dashboard/Product/Index', [
            'products' => Product::with('category', 'brand', 'images')->latest()->get()
        ]);
    }
    public function addProduct()
    {
        return inertia('dashboard/Product/Add', [
                'categories' => Category::all(),
                'brands' => Brand::all(),
            ]);
    }
    public function storeProduct(ProductRequest $req)
    {

        $data = $req->validated();
        $data['user_id'] = Auth::id();
        $product = Product::create($data);


        $images = request()->images;

        $imageData = [];
        foreach( $images as $image){
            $imageData[] = [
                'url' => '/storage/'.$image['file']->store('uploads', 'public'),
                'product_id' => $product->id
            ];
        }
        Image::insert($imageData);
        return to_route('product.all');
    }
    public function editProduct($slug)
    {
        return inertia('dashboard/Product/Edit', [
            "product" => Product::where('slug', $slug)->with('category', 'images')->first(),
            "categories" => Category::all(),
            "brands" => Brand::all(),
        ]);
    }

    public function deleteProductImage($id) {
        $image = Image::where('id', $id)->first();
        $imagePath = str_replace('/storage', 'public', $image->url);
        Storage::delete($imagePath);
        $image->delete();
    }
    public function updateProduct($slug) {
        $product = Product::where('slug', $slug)->first();

        $data = Request::all();
        $data['user_id'] = Auth::id();

        $images = $data['newImage'];
        $imageData = [];

        foreach( $images as $image){
            $imageData[] = [
                'url' => '/storage/'.$image['file']->store('uploads', 'public'),
                'product_id' => $product->id
            ];
        }
        Image::insert($imageData);

        $product->update($data);
        return to_route('product.all');
    }

    public function deleteProduct($id){
        $product = Product::where('id', $id)->first();
        if ($product) {
            $images = $product->images;
            foreach ($images as $image) {
                $imagePath = str_replace('/storage', 'public', $image->url);
                Storage::delete($imagePath);
                $image->delete();
            }
            $product->delete();
        }
    }
}
