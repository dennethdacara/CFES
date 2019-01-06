<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\ScheduleRequest;
use App\Http\Controllers\Controller;
use App\Model\Gradelevel, App\Model\Section, App\Model\Subject;
use App\User, App\Model\Schedule, App\Model\SchoolYear;
use App\Model\Faculty, App\Model\Room, App\Model\Role;
use DB;

class ScheduleController extends Controller
{

    public function index()
    {
        $schedules = Schedule::leftjoin('subjects','subjects.id','schedules.subject_id')
            ->leftjoin('sections','sections.id','schedules.section_id')
            ->leftjoin('users as faculties','faculties.id','schedules.faculty_id')
            ->leftjoin('rooms','rooms.id','schedules.room_id')
            ->get([
                'schedules.*', 'subjects.name as subject', 'sections.name as section',
                \DB::raw("(CONCAT(faculties.firstname,' ',faculties.lastname)) as faculty"),
                'rooms.name as room',
                \DB::raw("(CONCAT(schedules.start_time,' - ',schedules.end_time)) as time")
            ]);

        return view ('v1/views/admin/schedules/index', compact('schedules'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $sections = Section::all();
        $rooms = Room::all();

        $faculties = User::whereRoleId(Role::_FACULTY)->get([
            'users.*', \DB::raw("(CONCAT(users.firstname,' ',users.lastname)) as fullname"),
        ]);

        return view ('v1/views/admin/schedules/create',
            compact('subjects', 'sections', 'faculties', 'rooms'));
    }

    public function store(ScheduleRequest $request)
    {
        //return $request->all();

        $start_time = date('H:i:s', strtotime($request->start_time));
        $end_time = date('H:i:s', strtotime($request->end_time));

        $defaultSY = SchoolYear::whereIsActive(true)->first();

        Schedule::create([
            'sy_id' => $defaultSY->id,
            'subject_id' => $request->subject_id,
            'section_id' => $request->section_id,
            'faculty_id' => $request->faculty_id,
            'room_id' => $request->room_id,
            'days' => json_encode($request->days),
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);

        return back()->with('success', 'Successfully added!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $subjects = Subject::all();
        $sections = Section::all();
        $rooms = Room::all();

        $faculties = User::whereRoleId(Role::_FACULTY)->get([
            'users.*', \DB::raw("(CONCAT(users.firstname,' ',users.lastname)) as fullname"),
        ]);

        $schedule = Schedule::find($id);

        return view ('v1/views/admin/schedules/edit',
            compact('subjects', 'sections', 'faculties', 'rooms', 'schedule'));
    }

    public function update(ScheduleRequest $request, $id)
    {
        $schedule = Schedule::find($id)->update([
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
            'faculty_id' => $request->faculty_id,
            'room_id' => $request->room_id,
            'days' => json_encode($request->days),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return back()->with('success', 'Successfully updated!');
    }

    public function destroy($id)
    {
        $schedule = Schedule::find($id)->delete();
        return back()->with('success', 'Successfully deleted!');
    }
}
