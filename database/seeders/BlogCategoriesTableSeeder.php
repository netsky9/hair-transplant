<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $firstCatTitle = 'No category';
        $categories = [
            [
                'parent_id' => 0,
                'slug'      => Str::slug($firstCatTitle),
                'title'     => $firstCatTitle,
            ]
        ];

        $otherCatTitle = 'Category #';
        for($i = 1; $i <= 10; $i++){
            $categories[] = [
                'parent_id' => ($i <= 5)? rand(1,5) : 1,
                'slug'      => Str::slug($firstCatTitle.$i),
                'title'     => $otherCatTitle.$i,
            ];
        }

        \DB::table('blog_categories')->insert($categories);
    }
}
