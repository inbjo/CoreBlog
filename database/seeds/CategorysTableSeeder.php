<?php

use Illuminate\Database\Seeder;
use \App\Models\Category;

class CategorysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorys = factory(Category::class)->times(5)->make();
        Category::insert($categorys->toArray());
    }
}
