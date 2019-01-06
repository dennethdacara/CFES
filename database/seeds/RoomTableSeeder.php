<?php

use Illuminate\Database\Seeder;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->truncate();
        $json = storage_path() . "/json_data/rooms.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\Model\Room::create([
                'id' => $obj->id,
                'name' => $obj->name
            ]);
        }
    }
}
