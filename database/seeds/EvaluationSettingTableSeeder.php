<?php

use Illuminate\Database\Seeder;

class EvaluationSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('evaluation_settings')->truncate();
        $json = storage_path() . "/json_data/evaluation_settings.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\Model\EvaluationSetting::create([
                'id' => $obj->id,
                'start_date' => $obj->start_date,
                'end_date' => $obj->end_date
            ]);
        }
    }
}
