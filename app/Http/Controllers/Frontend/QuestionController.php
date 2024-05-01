<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::query()->with('product');
        if (\request()->has('onlyData')){
            return response()->json($questions->get(), 200);
        }else{
            $questions = $questions->paginate(10)->withQueryString();
            return response()->json($questions, 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required',
            'question' => 'required',
        ]);
        $data['user_id'] = Auth::user()->id;
        $data['email'] = Auth::user()->email;
        $data['name'] = Auth::user()->name;
        Question::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($productId)
    {
        $questions = Question::query()->where('product_id', $productId)->get();
        return response()->json($questions, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $data = $request->all();
        $question->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return response('Review Delete Successfully Done...');
    }
}
