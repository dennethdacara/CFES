<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\EvaluationSettingsRequest;
use App\Http\Controllers\Controller;
use App\Model\EvaluationSetting;
use DB;

class EvaluationDurationSettingsController extends Controller
{

    public function index()
    {
        $evaluationSettings = EvaluationSetting::first();
        return view('v1/views/admin/evaluation_settings/index', compact('evaluationSettings'));
    }

    public function update(EvaluationSettingsRequest $request, $id)
    {
        $evaluationSetting = EvaluationSetting::find($id)
            ->update([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);

        return back()->with('success', 'Evaluation Settings updated successfully.');
    }
}
