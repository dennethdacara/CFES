<?php

use Illuminate\Database\Seeder;

class RatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ratings')->truncate();
        $json = storage_path() . "/json_data/ratings.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\Model\Rating::create([
                'id' => $obj->id,
                'name' => $obj->name
            ]);
        }
    }
}
