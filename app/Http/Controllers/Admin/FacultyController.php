<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Faculty, App\User, App\Model\Role;
use DB;

class FacultyController extends Controller
{

    public function index()
    {
        $faculties = User::leftjoin('faculties','faculties.user_id','users.id')
            ->where('users.role_id', Role::_FACULTY)
            ->get(['users.*', 'faculties.employee_no'])
            ->map(function ($data) {
                $data->fullname = $data->firstname.' '.$data->lastname;
                $data->gender == 1 ? $data->gender = 'Male' : $data->gender = 'Female';
                return $data;
            });

        return view ('v1/views/admin/faculties/index', compact('faculties'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
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

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        // DB::beginTransaction();
        // try {
        //     $faculty = Faculty::whereUserId($id)->first();
        //     User::find($faculty->user_id)->delete();
        //     $faculty->delete();
        //     DB::commit();
        //     return back()->with('success', 'Successfully deleted!');
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return back()->with('error', $e->getMessage());
        // }
    }

    public function toggleActivation($userID)
    {
        $faculty = User::find($userID);

        if ($faculty->is_active) {
            $faculty->update(['is_active' => 0]);
            $message = 'User has been deactivated';
        } else {
            $faculty->update(['is_active' => 1]);
            $message = 'User has been activated';
        }

        return back()->with('succcess', $message);
    }
}
