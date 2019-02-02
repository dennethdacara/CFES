<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\StudentRequest;
use App\Http\Controllers\Controller;
use App\Model\Student, App\Model\Gradelevel;
use App\User, App\Model\Role, App\Model\Section;
use DB, Input;

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
        DB::beginTransaction();
        try {

            $exists = User::whereFirstnameAndLastname($request->firstname, $request->lastname)->exists();
            $emailExists = User::whereEmail($request->email)->exists();

            if ($exists)
                return back()->with('error', "Student Already exists!")->withInput(Input::all());

            $newUser = User::create([
                'role_id' => Role::_STUDENT,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'gender' => $request->gender,
                'email' => $request->student_no.'@gmail.com',
                'image' => 'student.png',
                'username' => $request->student_no,
                'password' => bcrypt('password'),
                'slug' => str_slug($request->firstname.' '.$request->lastname)
            ]);

            Student::create([
                'user_id' => $newUser->id,
                'gradelevel_id' => $request->gradelevel_id,
                'section_id' => $request->section_id,
                'student_no' => $request->student_no,
                'lrn' => $request->lrn
            ]);

            DB::commit();
            return back()->with('success', 'Successfully added!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

        $student = Student::leftjoin('users','users.id','students.user_id')
            ->leftjoin('gradelevels','gradelevels.id','students.gradelevel_id')
            ->leftjoin('sections','sections.id','students.section_id')
            ->first([\DB::raw("(CONCAT(users.firstname,' ',users.lastname)) as fullname"),
                'users.firstname', 'users.middlename', 'users.lastname',
                'users.email', 'users.gender',
                'gradelevels.name as gradelevel', 'sections.name as section',
                'students.*',
            ]);

        $gradelevels = Gradelevel::whereIn('id', [11,12])->get();
        $sections = Section::all();
        return view ('v1/views/admin/students/edit', compact('student', 'gradelevels', 'sections'));
    }

    public function update(StudentRequest $request, $id)
    {

        DB::beginTransaction();
        try {

            $user = User::find($request->user_id)->update([
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'gender' => $request->gender,
                //'email' => $request->email,
                'slug' => $request->firstname.' '.$request->lastname
            ]);

            $student = Student::find($id)->update([
                'student_no' => $request->student_no,
                'lrn' => $request->lrn,
                'gradelevel_id' => $request->gradelevel_id,
                'section_id' => $request->section_id
            ]);

            DB::commit();
            return back()->with('success', 'Successfully updated!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }

    }

    public function destroy($id)
    {
        $student = Student::find($id);
        $user = User::find($student->user_id)->delete();
        $student->delete();
        return back()->with('success', 'Successfully deleted');
    }
}
