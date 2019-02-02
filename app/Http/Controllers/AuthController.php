<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, DB, App\User, App\Model\Role;
use App\Model\Student, App\Model\Faculty;
use App\Model\Schedule, App\Model\StudentFacultyEvaluation;

class AuthController extends Controller
{
    public function checkAuth()
    {

        if (!Auth::user()->is_active) {
            Auth::logout();
            return back()->with('error', 'User has been deactivated.');
        }

        if (Auth::user()->role_id == Role::_ADMIN) : return view ('v1/views/admin/home'); endif;

        if (Auth::user()->role_id == Role::_STUDENT) : return redirect('evaluateTeacherSelection'); endif;

        if (Auth::user()->role_id == Role::_FACULTY) : return redirect ('facultyEvaluationSummary'); endif;
    }
}
