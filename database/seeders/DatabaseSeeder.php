<?php

namespace Database\Seeders;

use App\Models\Category;
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
        // It actually save it to the database.
        // If you don't want to save on the database
        // you can use `make()` instead of `create()`.
        Category::factory(12)->create();
    }
}
