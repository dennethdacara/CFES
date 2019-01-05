<?php

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->truncate();
        $json = storage_path() . "/json_data/questions.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\Model\Question::create([
                'id' => $obj->id,
                'section_id' => $obj->section_id,
                'subject_id' => $obj->subject_id,
                'type' => $obj->type,
                'name' => $obj->name
            ]);
        }
    }
}
