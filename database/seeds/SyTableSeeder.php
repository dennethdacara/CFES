<?php

use Illuminate\Database\Seeder;

class SyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('school_years')->truncate();
        $json = storage_path() . "/json_data/sy.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\Model\SchoolYear::create([
                'id' => $obj->id,
                'start' => $obj->start,
                'end' => $obj->end,
                'is_active' => $obj->is_active
            ]);
        }
    }
}
