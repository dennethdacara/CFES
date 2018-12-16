<?php

use Illuminate\Database\Seeder;

class GradelevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gradelevels')->truncate();
        $json = storage_path() . "/json_data/gradelevels.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\Model\Gradelevel::create([
                'id' => $obj->id,
                'name' => $obj->name,
                'sort_order' => $obj->sort_order,
                'is_active' => $obj->is_active
            ]);
        }
    }
}
