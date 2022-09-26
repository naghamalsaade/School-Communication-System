<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(190)->create();
        \App\Models\Administrator::factory(10)->create();
        \App\Models\Student::factory(180)->create();
        \App\Models\Event::factory(30)->create();
        \App\Models\AttendanceCheck::factory(30)->create();
        \App\Models\ComplaintReceiver::factory(10)->create();

    }
}
