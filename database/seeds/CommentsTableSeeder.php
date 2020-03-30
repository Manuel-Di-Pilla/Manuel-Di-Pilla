<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Comment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 100; $i++) { 
            $newComment = new Comment;
            $newComment->name = $faker->name();
            $newComment->text = $faker->paragraph(20);
            $newComment->post_id = Post::inRandomOrder()->first()->id;
            $newComment->save();
        }
    }
}
