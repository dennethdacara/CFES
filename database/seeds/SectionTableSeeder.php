<?php

use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->truncate();
        $json = storage_path() . "/json_data/sections.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\Model\Section::create([
                'id' => $obj->id,
                'sy_id' => $obj->sy_id,
                'gradelevel_id' => $obj->gradelevel_id,
                'adviser_id' => $obj->adviser_id,
                'name' => $obj->name
            ]);
        }
    }
}
