<?php

use Illuminate\Database\Seeder;

class ChoiceQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('choice_question')->truncate();
        $json = storage_path() . "/json_data/choice_question.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\Model\ChoiceQuestion::create([
                'id' => $obj->id,
                'choice_id' => $obj->choice_id,
                'question_id' => $obj->question_id
            ]);
        }
    }
}
