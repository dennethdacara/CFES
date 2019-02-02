<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Semester;
use DB;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = Semester::all();
        return view('v1/views/shared/semesters/index', compact('semesters'));
    }

    public function setAsActive($id)
    {
        $sem = Semester::find($id)->update(['is_active' => 1]);
        $sem1 = Semester::where('id', '<>', $id)->update(['is_active' => 0]);
        return back()->with('success', 'Active semester has been set.');
    }
}
