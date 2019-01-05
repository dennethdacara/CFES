<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(FacultyTableSeeder::class);
        $this->call(SyTableSeeder::class);
        $this->call(RatingTableSeeder::class);
        $this->call(GradelevelTableSeeder::class);
        $this->call(SectionTableSeeder::class);
        $this->call(SubjectTableSeeder::class);
        $this->call(ChoiceTableSeeder::class);
        $this->call(QuestionTableSeeder::class);
        $this->call(ChoiceQuestionTableSeeder::class);
    }
}
