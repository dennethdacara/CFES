<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\SubjectRequest;
use App\Http\Controllers\Controller;
use DB, App\User;
use App\Model\Gradelevel, App\Model\Role;
use App\Model\Subject;

class SubjectController extends Controller
{

    public function index()
    {
        $subjects = Subject::leftjoin('gradelevels','gradelevels.id','subjects.gradelevel_id')
            ->latest()
            ->get(['subjects.*', 'gradelevels.name as gradelevel']);
            
        return view ('v1/views/admin/subjects/index', compact('subjects'));
    }

    public function create()
    {
        $gradelevels = Gradelevel::whereIsActive(1)->oldest('sort_order')->get();
        return view ('v1/views/admin/subjects/create', compact('gradelevels'));
    }

    public function store(SubjectRequest $request)
    {
        try {
            Subject::create($request->all());
            return back()->with('success', 'Successfully added!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $subject = Subject::find($id);
        $gradelevels = Gradelevel::whereIsActive(1)->oldest('sort_order')->get();
        return view ('v1/views/admin/subjects/edit', compact('subject', 'gradelevels'));
    }

    public function update(SubjectRequest $request, $id)
    {
        try {
            Subject::find($id)->update($request->except(['subject_id']));
            return back()->with('success', 'Successfully added!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $section = Subject::whereId($id)->delete();
            return back()->with('success', 'Successfully deleted!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
