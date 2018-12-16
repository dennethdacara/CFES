<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\SectionRequest;
use App\Http\Controllers\Controller;
use DB, App\User;
use App\Model\Gradelevel, App\Model\Role;
use App\Model\Section, App\Model\SchoolYear;

class SectionController extends Controller
{

    public function index()
    {
        $sections = Section::leftjoin('school_years as sy','sy.id','sections.sy_id')
            ->leftjoin('gradelevels','gradelevels.id','sections.gradelevel_id')
            ->leftjoin('users as advisers','advisers.id','sections.adviser_id')
            ->latest()
            ->get(['sections.*', DB::raw("(CONCAT(advisers.firstname,' ',advisers.lastname)) as adviser"),
                DB::raw("(CONCAT(sy.start,'-',sy.end)) as sy"), 'gradelevels.name as gradelevel'
            ]);

        return view ('v1/views/admin/sections/index', compact('sections'));
    }

    public function create()
    {
        $schoolyears = SchoolYear::all();
        $gradelevels = Gradelevel::whereIsActive(1)->oldest('sort_order')->get();
        $advisers = User::whereRoleId(Role::_FACULTY)->get([
            'users.*', DB::raw("(CONCAT(users.firstname,' ',users.lastname)) as fullname")
        ]);

        return view ('v1/views/admin/sections/create', compact('schoolyears', 'gradelevels', 'advisers'));
    }

    public function store(SectionRequest $request)
    {
        try {
            Section::create($request->all());
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
        $section = Section::find($id);
        $schoolyears = SchoolYear::all();
        $gradelevels = Gradelevel::whereIsActive(1)->get();
        $advisers = User::whereRoleId(Role::_FACULTY)->get([
            'users.*', DB::raw("(CONCAT(users.firstname,' ',users.lastname)) as fullname")
        ]);
        
        return view ('v1/views/admin/sections/edit', compact('section', 'schoolyears', 'gradelevels', 'advisers'));
    }

    public function update(SectionRequest $request, $id)
    {
        try {
            $section = Section::find($id)->update($request->except(['section_id']));
            return back()->with('success', 'Successfully updated!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $section = Section::whereId($id)->delete();
            return back()->with('success', 'Successfully deleted!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
