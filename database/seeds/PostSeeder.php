<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;



class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $arr_category_id = Category::pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post->category_id = Arr::random($arr_category_id);
            $post->title = $faker->sentence(3);
            $post->description = $faker->paragraph(3);
            $post->image = $faker->imageUrl(360, 360);
            $post->slug = Str::slug($post->title, '-');
            $post->save();
        }
    }
}
