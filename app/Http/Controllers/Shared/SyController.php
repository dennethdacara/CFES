<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Requests\Shared\SyRequest;
use App\Http\Controllers\Controller;
use App\Model\SchoolYear;
use DB;

class SyController extends Controller
{

    public function index()
    {
        $sy = SchoolYear::all();
        return view ('v1/views/shared/sy/index', compact('sy'));
    }

    public function syStartYearApi()
    {
        $latestStartYear = SchoolYear::max('start') + 1;

        for($x=0;$x<10;$x++)
            $availableStartYears[] = $latestStartYear + $x;

        return response()->json([
            'type' => 'Sy start year api',
            'data' => $availableStartYears
        ], 200);
    }

    public function create()
    {
        return view ('v1/views/shared/sy/create');
    }

    public function store(SyRequest $request)
    {
        SchoolYear::firstOrCreate($request->except(['_token']));
        return back()->with('success', 'Successfully added!');
    }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        SchoolYear::find($id)->delete();
        return back()->with('success', 'Successfully deleted!');
    }

    public function setAsActive($id)
    {
        $sy = SchoolYear::find($id)->update(['is_active' =>  1]);
        $sy1 = SchoolYear::where('id', '<>', $id)->update(['is_active' => 0]);
        return back()->with('success', 'New active schoolyear has been set!');
    }
}
