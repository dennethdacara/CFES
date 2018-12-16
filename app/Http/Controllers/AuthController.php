<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, DB, App\User, App\Model\Role;

class AuthController extends Controller
{
    public function checkAuth()
    {
        if (Auth::user()->role_id == Role::_ADMIN) : return view ('v1/views/admin/home'); endif;
        if (Auth::user()->role_id == Role::_STUDENT) : return view ('v1/views/student/home'); endif;
        if (Auth::user()->role_id == Role::_FACULTY) : return view ('v1/views/faculty/home'); endif;
    }
}
