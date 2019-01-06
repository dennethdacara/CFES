<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\StudentRequest;
use App\Http\Controllers\Controller;
use App\Model\Student, App\Model\Gradelevel;
use App\User, App\Model\Role, App\Model\Section;
use DB;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::leftjoin('users','users.id','students.user_id')
            ->leftjoin('gradelevels','gradelevels.id','students.gradelevel_id')
            ->leftjoin('sections','sections.id','students.section_id')
            ->get([\DB::raw("(CONCAT(users.firstname,' ',users.lastname)) as fullname"),
                'gradelevels.name as gradelevel',
                'sections.name as section',
                'students.*',
            ]);

        return view ('v1/views/admin/students/index', compact('students'));
    }

    public function create()
    {
        $gradelevels = Gradelevel::whereIn('id', [11,12])->get();
        $sections = Section::all();
        return view ('v1/views/admin/students/create', compact('gradelevels', 'sections'));
    }

    public function store(StudentRequest $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(StudentRequest $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        $user = User::find($student->user_id)->delete();
        $student->delete();
        return back()->with('success', 'Successfully deleted');
    }
}
