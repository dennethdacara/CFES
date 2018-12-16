<?php

use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->truncate();
        $json = storage_path() . "/json_data/subjects.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\Model\Subject::create([
                'id' => $obj->id,
                'gradelevel_id' => $obj->gradelevel_id,
                'code' => $obj->code,
                'name' => $obj->name
            ]);
        }
    }
}
