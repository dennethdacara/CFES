<?php

use Illuminate\Database\Seeder;

class FacultyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculties')->truncate();
        $json = storage_path() . "/json_data/faculties.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\Model\Faculty::create([
                'id' => $obj->id,
                'user_id' => $obj->user_id,
                'employee_no' => $obj->employee_no
            ]);
        }
    }
}
