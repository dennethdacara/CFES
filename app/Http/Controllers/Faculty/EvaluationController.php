<?php

namespace App\Http\Controllers\Faculty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ChoiceQuestion, App\Model\Choice, App\Model\Question, App\Model\Rating;
use App\Model\StudentFacultyEvaluation, App\Model\Student, App\Model\Schedule;
use Auth, DB;

class EvaluationController extends Controller
{
    public function index()
    {
        $syID = $this->activeSyID();
        $sem = $this->activeSem();
        $facultyID = Auth::user()->id;
        $sectionIDs = Schedule::whereSyIdAndSemIdAndFacultyId($syID, $sem->id, $facultyID)->distinct()->pluck('section_id');

        $questionIDs = StudentFacultyEvaluation::whereFacultyId($facultyID)
            ->whereSyId($syID)
            ->whereSemId($sem->id)
            ->distinct()
            ->pluck('question_id')
            ->toArray();
        
        $studentIDs = Student::whereIn('section_id', $sectionIDs)->distinct()->pluck('id');
        $studentsEvaluated = StudentFacultyEvaluation::whereFacultyId($facultyID)
            ->whereSyId($syID)
            ->whereSemId($sem->id)
            ->whereIn('student_id', $studentIDs)
            ->distinct()
            ->pluck('student_id')
            ->toArray();

        $totalStudentsEvaluated = count($studentsEvaluated);

        $evaluationSummary = Question::whereIn('id', $questionIDs)->get()
            ->map(function ($data) use ($syID, $sem, $facultyID) {

                $choiceIDs = ChoiceQuestion::whereQuestionId($data->id)->distinct()->pluck('choice_id')->toArray();
                $totalChoices = count($choiceIDs);

                $choices = ChoiceQuestion::leftjoin('choices','choices.id','choice_question.choice_id')
                    ->where('choice_question.question_id', $data->id)
                    ->get()
                    ->map(function ($data1) use ($syID, $sem, $facultyID) {
                        //SubjectsScheduleSubmission::select(DB::raw('COUNT(*) as count'))->whereIn('subject_schedule_id', $subjectSchedIDs)->get();
                        $totalPoints = StudentFacultyEvaluation::select(DB::raw('COUNT(*) as count'))
                            ->whereSyId($syID)->whereSemId($sem->id)->whereFacultyId($facultyID)
                            ->whereQuestionId($data1->question_id)
                            ->whereChoiceId($data1->choice_id)->first();

                        $data1->total = $totalPoints->count;
                        return $data1;
                });

                $data->totalChoices = $totalChoices;
                $data->choices = $choices;
                return $data;
            });

        return view('v1/views/faculty/evaluation_summary/index', compact('sem', 'evaluationSummary', 'totalStudentsEvaluated'));
    }
}
