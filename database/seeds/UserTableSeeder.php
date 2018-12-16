<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $json = storage_path() . "/json_data/users.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\User::create([
                'id' => $obj->id,
                'role_id' => $obj->role_id,
                'firstname' => $obj->firstname,
                'lastname' => $obj->lastname,
                'gender' => $obj->gender,
                'image' => $obj->image,
                'email' => $obj->email,
                'username' => $obj->username,
                'password' => bcrypt('password'),
                'slug' => str_slug($obj->firstname.' '.$obj->lastname)
            ]);
        }
    }
}
