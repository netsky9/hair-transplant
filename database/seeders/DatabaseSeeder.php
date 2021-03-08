<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Clinic;
use App\Models\Comment;
use App\Models\Report;
use App\Models\Review;
use App\Models\User;
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
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            BlogCategoriesTableSeeder::class,
        ]);

        BlogPost::factory()
            ->count(100)
            ->create();

        User::factory()
            ->count(20)
            ->create();

        /**
         * 30 test clinics, don't change
         */
        Clinic::factory()
            ->count(30)
            ->create();

        Review::factory()
            ->count(200)
            ->create();

        Report::factory()
            ->count(90)
            ->create();

        Comment::factory()
            ->count(400)
            ->create();
    }
}
