<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Requests\Student\Comment\PostRequest;
use App\Http\Controllers\Controller;
use Auth, App\Model\User, App\Model\Student;
use App\Model\Comment;

class CommentController extends Controller
{

    public function index()
    {
        $studentInfo = Student::leftjoin('users','users.id','students.user_id')
            ->where('users.id', Auth::user()->id)
            ->first(['users.*', 'students.id as student_id', 'students.section_id']);

        $comments = Comment::leftjoin('school_years', 'school_years.id', 'comments.sy_id')
            ->leftjoin('users as faculty', 'faculty.id', 'comments.faculty_id')
            ->leftjoin('subjects', 'subjects.id', 'comments.subject_id')
            ->where('comments.student_id', $studentInfo->student_id)
            ->get(['school_years.start', 'school_years.end', 'comments.*', 'faculty.firstname', 'faculty.lastname', 'subjects.name as subject'
            ])->map(function ($data) {
                $data->sy = $data->start.' - '.$data->end;
                $data->faculty = $data->firstname.' '.$data->lastname;
                return $data;
            });

        return view ('v1/views/student/comments/index', compact('comments'));
    }

    public function create()
    {
        //
    }

    public function store(PostRequest $request)
    {
        Comment::create([
            'sy_id' => $this->activeSYID(),
            'subject_id' => $request->subject_id,
            'faculty_id' => $request->faculty_id,
            'student_id' => $request->student_id,
            'comment' => $request->comment
        ]);

        return back()->with('success', 'Comment posted successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
