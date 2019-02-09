<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\ReportRequest;
use App\Http\Controllers\Controller;
use App\Model\Student, App\Model\StudentFacultyEvaluation;
use App\User, App\Model\Faculty, App\Model\Role;

class ReportsController extends Controller
{
    public function index()
    {
        return view('v1/views/admin/reports/index');
    }

    public function displayReports(ReportRequest $request, $startDate = '', $endDate = '')
    {

        $syID = $this->activeSyID();
        $semID = $this->activeSemID();

        if ($request->report_type == 'listOfEvaluators') {

            $studentIDs1 = Student::distinct()->pluck('id');
            $totalStudents = Student::count();
            $studentsEvaluated = StudentFacultyEvaluation::whereSyId($syID)
                ->whereSemId($semID)
                ->whereIn('student_id', $studentIDs1)
                ->distinct()
                ->pluck('student_id')
                ->toArray();

            $totalStudentsEvaluated = count($studentsEvaluated);
            $title = 'Report Type: List of evaluators | Total Evaluators: '.$totalStudentsEvaluated.'/'.$totalStudents;
            $reportType = 'listOfEvaluators';
            $tableHeaders = ['#', 'Evaluator Name', 'Gradelevel', 'Section'];

            if($request->start_date && $request->end_date) {
                $studentIDs = StudentFacultyEvaluation::whereSyId($syID)
                    ->whereBetween('student_faculty_evaluation.created_at', [$request->start_date, $request->end_date])
                    ->whereSemId($semID)->distinct()->pluck('student_id');

                $oldStartDate = $request->start_date;
                $oldEndDate = $request->end_date;
            } else {
                $studentIDs = StudentFacultyEvaluation::whereSyId($syID)->whereSemId($semID)->distinct()->pluck('student_id');
                $oldStartDate = '';
                $oldEndDate = '';
            }

            $students = Student::leftjoin('users','users.id','students.user_id')
                ->leftjoin('gradelevels','gradelevels.id','students.gradelevel_id')
                ->leftjoin('sections','sections.id','students.section_id')
                ->whereIn('students.id', $studentIDs)
                ->get(['students.id as student_id', 'users.*', 'gradelevels.name as gradelevel', 'sections.name as section'])
                ->map(function ($data) {
                    $data->fullname = $data->firstname.' '.$data->middlename.' '.$data->lastname;
                    return $data;
                });

            $data = [];
            foreach ($students as $student) {
                $data[] = [
                    'id' => $student->id,
                    'student_name' => $student->fullname,
                    'gradelevel' => $student->gradelevel,
                    'section' => $student->section
                ];
            }

        }

        if ($request->report_type == 'listOfEvaluatedTeachers') {

            $title = 'Report Type: List of evaluated teachers';
            $reportType = 'listOfEvaluatedTeachers';
            $tableHeaders = ['#', 'Fullname', 'Status'];

            $teacherIDs = StudentFacultyEvaluation::whereSyIdAndSemId($syID, $semID)->pluck('faculty_id');
            $teachers = User::whereRoleId(Role::_FACULTY)
                ->whereIn('id', $teacherIDs)
                ->get()
                ->map(function ($data) {
                    $data->fullname = $data->firstname.' '.$data->middlename.' '.$data->lastname;
                    $data->is_active ? $status = 'Active' : $status = 'Inactive';
                    $data->status = $status;
                    return $data;
                });

            $data = [];
            foreach ($teachers as $teacher) {
                $data[] = [
                    'id' => $teacher->id,
                    'fullname' => $teacher->fullname,
                    'status' => $teacher->status
                ];
            }
        }

        if ($request->report_type == 'listOfActiveInactiveTeachers') {
            $title = 'Report Type: List of Active/Inactive Teachers';
            $reportType = 'listOfActiveInactiveTeachers';
            $tableHeaders = ['#', 'Teacher Name', 'Status'];

            $faculties = User::whereRoleId(Role::_FACULTY)
                ->get()
                ->map(function ($data) {
                    $data->fullname = $data->firstname.' '.$data->middlename.' '.$data->lastname;
                    $data->is_active ? $status = 'Active' : $status = 'Inactive';
                    $data->status = $status;
                    return $data;
                });

            $oldStartDate = '';
            $oldEndDate = '';

            $data = [];
            foreach ($faculties as $faculty) {
                $data[] = [
                    'id' => $faculty->id,
                    'faculty_name' => $faculty->fullname,
                    'status' => $faculty->status
                ];
            }

        }


        return view ('v1/views/admin/reports/results', compact('title', 'reportType', 'tableHeaders', 'data', 'oldStartDate', 'oldEndDate'));
    }
}
