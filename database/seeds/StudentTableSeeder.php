<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->truncate();
        $json = storage_path() . "/json_data/students.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\Model\Student::create([
                'id' => $obj->id,
                'user_id' => $obj->user_id,
                'gradelevel_id' => $obj->gradelevel_id,
                'section_id' => $obj->section_id,
                'student_no' => $obj->student_no,
                'lrn' => $obj->lrn
            ]);
        }
    }
}
