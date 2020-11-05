<?php

use Illuminate\Database\Seeder;
use App\Models\Student\student;

class seederStudent extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        student::create([
            'name' => 'Ahmed Hamza',
            'email' => 'mbdalzym376@yahoo.com',
            'password' => bcrypt('123456')
        ]);
    }
}
