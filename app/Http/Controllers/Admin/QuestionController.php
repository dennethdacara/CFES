<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\QuestionRequest;
use App\Http\Controllers\Controller;
use App\Model\Question, App\Model\Subject;
use App\Model\Choice, App\Model\ChoiceQuestion;
use App\Model\Section;
use DB;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::leftjoin('subjects','subjects.id','questions.subject_id')
            ->leftjoin('sections','sections.id','questions.section_id')
            ->get(['questions.*', 'subjects.name as subject', 'subjects.code as code', 'sections.name as section'])
            ->map(function($data){
                $data->is_active === 1 ? $activeStatus = 'Yes' : $activeStatus = 'No';
                $data->activeStatus = $activeStatus;
                return $data;
            });

        return view ('v1/views/admin/questions/index', compact('questions'));
    }

    public function create()
    {
        $sections = Section::all();
        $subjects = Subject::all();
        $choices = Choice::all();
        return view ('v1/views/admin/questions/create', compact('sections', 'subjects', 'choices'));
    }

    public function store(QuestionRequest $request)
    {
        DB::beginTransaction();
        try {

            $newQuestion = Question::create([
                'section_id' => $request->section_id,
                'subject_id' => $request->subject_id,
                'type' => $request->type,
                'name' => $request->name
            ]);

            foreach ($request->choice_id as $choiceID) {
                ChoiceQuestion::create([
                    'choice_id' => $choiceID,
                    'question_id' => $newQuestion->id
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
        $question = Question::find($id);
        $sections = Section::all();
        $subjects = Subject::all();
        $choices = Choice::all();
        $attachedChoices = ChoiceQuestion::whereQuestionId($id)->distinct()->pluck('choice_id');

        return view ('v1/views/admin/questions/edit', compact('question', 'sections', 'subjects', 'choices', 'attachedChoices'));
    }

    public function update(QuestionRequest $request, $id)
    {
        DB::beginTransaction();
        try {

            $question = Question::find($id)
                ->update([
                    'section_id' => $request->section_id,
                    'subject_id' => $request->subject_id,
                    'type' => $request->type,
                    'name' => $request->name
                ]);

            ChoiceQuestion::whereQuestionId($id)->delete();

            foreach ($request->choice_id as $choiceID) {
                ChoiceQuestion::create([
                    'choice_id' => $choiceID,
                    'question_id' => $id
                ]);
            }

            DB::commit();
            return back()->with('success', 'Successfully updated!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }

    }

    public function destroy($id)
    {
        $question = Question::find($id)->delete();
        return back()->with('success', 'Successfully deleted!');
    }
}
