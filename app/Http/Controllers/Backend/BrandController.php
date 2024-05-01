<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;

class BrandController extends Controller
{
    public function index()
    {
        return inertia('dashboard/Brand/Index', [
            'brands' => Brand::all(),
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
            'image' => 'required'
        ]);
        $data = Request::all();
        if(Request::hasFile('image')){
            $path ='/storage/'. Request::file('image')->store('uploads','public');
            $data ['image'] = $path;
        }
        Brand::create($data);
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
    public function update(Request $request, string $id)
    {



        $brand = Brand::find($id);

        $data = Request::all();
        if(Request::hasFile('image')){
            $path = '/storage/'. Request::file('image')->store('uploads','public');
            $data['image'] = $path;
        }

        $brand->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        $image = $brand->image;
        if($image){
            $imagePath = str_replace('/storage','public',$image);
            Storage::delete($imagePath);
        }
        $brand->delete();
    }
}
