<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use App\Models\Page;

class PageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {

        return inertia('dashboard/Pages/Index', [
            'pages' => Page::orderBy('created_at', 'desc')->get(),
            'main_url' => URL::route('pages.index'),
        ]);

//        return inertia('Pages/Index', [
//            'pages' => Page::query()
//                ->when(Request::input('search'), function ($query, $search) {
//                    $query->where('title', 'like', "%{$search}%");
//                })
//                ->latest()
//                ->paginate(Request::input('perPage') ?? 10)
//                ->withQueryString()
//                ->through(fn($page) => [
//                    'id' => $page->id,
//                    'title' => $page->title,
//                    'slug' => $page->slug,
//                    'summery' => $page->summery,
//                    'created_at' => $page->created_at,
//                    "edit_url" => URL::route('pages.edit', $page->id)
//
//                ]),
//            'filters' => Request::only(['search','perPage', 'dateRange']),
//            'main_url' => URL::route('pages.index')
//        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
        return inertia('dashboard/Pages/Create',[
            'main_url' => URL::route('pages.index')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $page = new Page();

        $page->title = Request::input('title');
        $page->summery = Request::input('summery');
        $page->status = filled(Request::input('status'));
        $page->is_delete= true;

        $page->seo_title = Request::input('seoTitle');
        $page->seo_description = Request::input('seoDescriptions');
        $page->seo_key_words = Request::input('seo_key_words');

        if (Request::hasFile('seoImage')){
            $icon = Request::file('seoImage')->store('uploads', 'public');
            $page->seo_icon = $icon;
        }
        $page->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function edit(Page $page)
    {
        return inertia('dashboard/Pages/Edit',[
            'update_url' => URL::route('pages.updatePage', $page->id),
            'page' => $page
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\RedirectResponse
     */


    public function updatePage($id)
    {
        $page = Page::findOrFail($id);

        if (Request::hasFile('seoImage')){
            $icon = Request::file('seoImage')->store('uploads', 'public');
            $page->icon = $icon;
        }

        $page->title = Request::input('title');
        $page->summery = Request::input('summery');
        $page->status = filled(Request::input('status'));
        $page->is_delete= true;

        $page->seo_title = Request::input('seoTitle');
        $page->seo_key_words = json_encode(Request::input('seoKeyWords'));
        $page->seo_description = Request::input('seoDescriptions');
        $page->update();

        return redirect()->route('pages.index')->with('message', 'Your page Updated...');
    }


    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return back();
    }
}
