<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\admin;

class seederAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        admin::create([
            'name' => 'Mahmoud abd alziem',
            'email' => 'mbdalzym376@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
