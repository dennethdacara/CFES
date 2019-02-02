<?php

use Illuminate\Database\Seeder;

class SemesterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('semesters')->truncate();
        $json = storage_path() . "/json_data/semesters.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\Model\Semester::create([
                'id' => $obj->id,
                'name' => $obj->name,
                'is_active' => $obj->is_active
            ]);
        }
    }
}
