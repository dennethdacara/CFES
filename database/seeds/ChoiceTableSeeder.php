<?php

use Illuminate\Database\Seeder;

class ChoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('choices')->truncate();
        $json = storage_path() . "/json_data/choices.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\Model\Choice::create([
                'id' => $obj->id,
                'name' => $obj->name
            ]);
        }
    }
}
