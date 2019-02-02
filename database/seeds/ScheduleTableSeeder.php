<?php

use Illuminate\Database\Seeder;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedules')->truncate();
        $json = storage_path() . "/json_data/schedules.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\Model\Schedule::create([
                'id' => $obj->id,
                'sy_id' => $obj->sy_id,
                'sem_id' => $obj->sem_id,
                'subject_id' => $obj->subject_id,
                'section_id' => $obj->section_id,
                'faculty_id' => $obj->faculty_id,
                'room_id' => $obj->room_id,
                'days' => json_encode($obj->days),
                'start_time' => $obj->start_time,
                'end_time' => $obj->end_time
            ]);
        }
    }
}
