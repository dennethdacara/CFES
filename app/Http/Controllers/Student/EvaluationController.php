<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, App\Model\Faculty, App\Model\Student;
use App\Model\Schedule, App\User, App\Model\Subject;
use App\Model\Question, App\Model\Choice, App\Model\ChoiceQuestion;
use App\Model\StudentFacultyEvaluation, App\Model\EvaluationSetting;

class EvaluationController extends Controller
{
    public function evaluateTeacherSelection()
    {
        $studentInfo = Student::leftjoin('users','users.id','students.user_id')
            ->where('users.id', Auth::user()->id)
            ->first(['users.*', 'students.id as student_id', 'students.section_id']);

        $facultyIDs = Schedule::whereSectionId($studentInfo->section_id)->distinct()->pluck('faculty_id');
        $syID = $this->activeSYID();

        $teachers = Faculty::leftjoin('users','users.id','faculties.user_id')
            ->leftjoin('schedules','schedules.faculty_id','users.id')
            ->leftjoin('subjects','subjects.id','schedules.subject_id')
            ->whereIn('users.id', $facultyIDs)
            ->get(['users.*', 'subjects.name as subject', 'subjects.id as subject_id', 'schedules.section_id', 'users.id as faculty_id'])
            ->map(function ($data) use ($syID, $studentInfo) {
                $data->fullname = $data->firstname.' '.$data->lastname;

                //check if subject is already evaluated
                $exists = StudentFacultyEvaluation::whereStudentId($studentInfo->student_id)
                    ->whereSubjectId($data->subject_id)
                    ->whereFacultyId($data->faculty_id)
                    ->whereSyId($syID)
                    ->exists();

                if($exists){
                    $data->status = 'disabled';
                } else {
                    $data->status = 'enabled';
                }

                return $data;
            });

        $evaluationSettings = EvaluationSetting::first();

        $dateToday = date('m/d/Y');
        $startDate = date('m/d/Y', strtotime($evaluationSettings->start_date));
        $endDate = date('m/d/Y', strtotime($evaluationSettings->end_date));

        return view ('v1/views/student/evaluation/evaluateTeacherSelection',
            compact('teachers', 'studentInfo', 'dateToday', 'startDate', 'endDate'));
    }

    public function evaluateTeacher($sectionID, $subjectID, $facultyID)
    {
        $studentInfo = Student::leftjoin('users','users.id','students.user_id')
            ->where('users.id', Auth::user()->id)
            ->first(['users.*', 'students.id as student_id', 'students.section_id']);

        $teacher = User::find($facultyID);
        $teacherFullName = $teacher->firstname.' '.$teacher->lastname;
        $subject = Subject::find($subjectID);
        $choices = Choice::leftjoin('choice_question','choice_question.choice_id','choices.id')->get(['choices.*', 'choice_question.question_id']);
        $availableQuestionIDs = ChoiceQuestion::distinct()->pluck('question_id');
        $questions = Question::whereSectionIdAndSubjectId($sectionID, $subjectID)->whereIn('id',$availableQuestionIDs)->get();

        return view ('v1/views/student/evaluation/evaluateTeacher',
            compact('teacherFullName', 'subject', 'questions', 'choices', 'studentInfo', 'teacher', 'sectionID'));
    }

    public function studentEvaluationStore(Request $request)
    {
        //return $request->all();

        foreach ($request->question_id as $questionIndex => $questionID) {
            StudentFacultyEvaluation::create([
                'sy_id' => $this->activeSYID(),
                'sem_id' => $this->activeSemID(),
                'subject_id' => $request->subject_id,
                'faculty_id' => $request->faculty_id,
                'question_id' => $questionID,
                'choice_id' => $request->choice_id[$questionIndex],
                'student_id' => $request->student_id
            ]);
        }

        return redirect('evaluateTeacherSelection')->with('success', 'Successfully submitted evaluation.');

    }
}
