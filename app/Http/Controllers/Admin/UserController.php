<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Controllers\Controller;
use App\Model\Role, App\User, App\Model\Faculty;
use App\Model\Student;
use DB, \Carbon\Carbon;

class UserController extends Controller
{

    public function index()
    {
        $users = User::leftjoin('roles','roles.id','users.role_id')
            ->where('users.is_active', 1)
            ->get(['users.*', 'roles.name as role'])
            ->map(function($data) {
                $data->fullname = $data->firstname.' '.$data->lastname;
                $data->gender == 1 ? $data->gender = 'Male' : $data->gender = 'Female';
                return $data;
            });
        return view ('v1/views/admin/users/index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('id', '!=', 2)->get();
        return view ('v1/views/admin/users/create', compact('roles'));
    }

    public function store(UserRequest $request)
    {

        DB::beginTransaction();
        try {

            $newUser = User::create([
                'role_id' => $request->role_id,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'gender' => $request->gender,
                'email' => $request->email,
                'username' => $request->email,
                'password' => bcrypt('password'),
                'slug' => str_slug($request->firstname.' '.$request->lastname)
            ]);

            if ($request->role_id == Role::_FACULTY) {
                $count = User::whereRoleId(Role::_FACULTY)->count() + 1;
                $newEmployeeNo = Carbon::now()->year.'-'.str_pad($count,4,'0', STR_PAD_LEFT);
                Faculty::create([
                    'user_id' => $newUser->id,
                    'employee_no' => $newEmployeeNo
                ]);
            }

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
        $user = User::find($id);
        $roles = Role::where('id', '!=', 2)->get();
        return view ('v1/views/admin/users/edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::find($id)->update([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'email' => $request->email,
            'username' => $request->email,
            'slug' => str_slug($request->firstname.' '.$request->lastname)
        ]);

        return back()->with('success', 'Successfully updated!');
    }

    public function destroy($id)
    {
        $user = User::find($id)->update(['is_active' => 0]);
        return back()->with('success', 'Successfully deleted!');
    }
}
