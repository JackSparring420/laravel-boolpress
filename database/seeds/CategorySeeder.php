<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 25) -> make() -> each(function($category){
            // $post = Post::inRandomOrder() -> limit(1) -> first();
            $category -> save();
        });
    }
}
