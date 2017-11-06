<?php

use Illuminate\Database\Seeder;
use App\Entities\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'  =>  '默认'
        ]);
    }
}
