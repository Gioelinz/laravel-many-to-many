<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
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

        //prendo tutti i tags id
        $arr_tags_id = Tag::pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post->category_id = Arr::random($arr_category_id);
            $post->title = $faker->sentence(3);
            $post->description = $faker->paragraph(3);
            $post->image = 'post_imgs/placeholder.png';
            $post->slug = Str::slug($post->title, '-');
            $post->save();

            //popolo per ogni giro tag randomici
            $rand_tags = Arr::random($arr_tags_id, rand(1, 5));
            $post->tags()->attach($rand_tags);
        }
    }
}
