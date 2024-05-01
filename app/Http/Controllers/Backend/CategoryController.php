<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('dashboard/Category/Index', [
            'categories' => Category::where('parent_id', 0)->get(),
        ]);
    }

    public function showSubCategory()
    {
        return inertia('dashboard/Category/SubCategory/Index', [
            'categories' => Category::where('parent_id', 0)->get(),
            'subCategories' => Category::where('parent_id', '>', 0)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        Request::validate([
            'name' => 'required',
            'image' => 'required',
        ]);
        $data = Request::all();

        if(Request::hasFile('image')){
            $path ='/storage/'.Request::file('image')->store('uploads','public');
            $data ['image'] = $path;
        }
        Category::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {

        Request::validate([
            'name' => 'required',
        ]);

        $category = Category::find($id);
        $data = Request::all();

        if(Request::hasFile('image')){
            $path = '/storage/'.Request::file('image')->store('uploads','public');
            $data['image'] = $path;
        }

        $category->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $image = $category->image;
        if($image){
            $imagePath = str_replace('/storage','public',$image);
            Storage::delete($imagePath);
        }
        $category->delete();
    }
}
