<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\QuestionRequest;
use App\Http\Controllers\Controller;
use App\Model\Question;
use DB;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::all();
        return view ('v1/views/admin/questions/index', compact('questions'));
    }

    public function create()
    {
        return view ('v1/views/admin/questions/create');
    }

    public function store(QuestionRequest $request)
    {
        Question::create($request->all());
        return back()->with('success', 'Successfully added!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $question = Question::find($id);
        return view ('v1/views/admin/questions/edit', compact('question'));
    }

    public function update(QuestionRequest $request, $id)
    {
        $question = Question::find($id)->update($request->all());
        return back()->with('success', 'Successfully updated!');
    }

    public function destroy($id)
    {
        $question = Question::find($id)->delete();
        return back()->with('success', 'Successfully deleted!');
    }
}
