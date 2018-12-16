<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\GradelevelRequest;
use App\Http\Controllers\Controller;
use App\Model\Gradelevel;

class GradelevelController extends Controller
{

    public function index()
    {
        $gradelevels = Gradelevel::oldest('sort_order')->get();
        return view ('v1/views/admin/gradelevels/index', compact('gradelevels'));
    }

    public function create()
    {
        $count = Gradelevel::count() + 1;
        return view ('v1/views/admin/gradelevels/create', compact('count'));
    }

    public function store(GradelevelRequest $request)
    {
        try {
            $request->is_active === "on" ? $isActive = true : $isActive = false;
            Gradelevel::create([
                'name' => $request->name,
                'sort_order' => $request->sort_order,
                'is_active' => $isActive
            ]);
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
        $gradelevel = Gradelevel::whereId($id)->first();
        $count = Gradelevel::count() + 1;
        return view ('v1/views/admin/gradelevels/edit', compact('gradelevel', 'count'));
    }

    public function update(GradelevelRequest $request, $id)
    {
        try {
            $request->is_active === "on" ? $isActive = true : $isActive = false;
            $gradelevel = Gradelevel::whereId($id)->update([
                'name' => $request->name,
                'sort_order' => $request->sort_order,
                'is_active' => $isActive
            ]);
            return back()->with('success', 'Successfully updated!');
        } catch (\Except $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $gradelevel = Gradelevel::whereId($id)->delete();
            return back()->with('success', 'Successfully deleted!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
