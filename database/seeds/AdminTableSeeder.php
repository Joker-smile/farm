<?php

use Illuminate\Database\Seeder;
use App\Entities\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'nickname'  =>  'Admin',
            'username'  =>  'admin',
            'password'  =>  bcrypt('abc123')
        ]);
    }
}
