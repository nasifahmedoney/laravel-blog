<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
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
        User::truncate();
        Category::truncate();
        Post::truncate();
        
        $user = User::factory()->create([
            'name' => 'nasif'
        ]);
        Post::factory(5)->create([
            'user_id' => $user->id
        ]);

        /*
        $user = User::factory()->create();

        $personal = Category::create(
            [
                'name' => 'Personal',
                'slug' => 'personal'
            ]
        );
        $family = Category::create(
            [
                'name' => 'Family',
                'slug' => 'family'
            ]
        );
        $work = Category::create(
            [
                'name' => 'Work',
                'slug' => 'work'
            ]
        );

        Post::create(
            [
                'user_id' => $user->id,
                'category_id' => $family->id,
                'title' => 'My Family Post',
                'slug' => 'my-family-post',
                'excerpt' => 'Exerpt of the post',
                'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, minima modi sit iure aperiam dicta quas ea ratione, similique praesentium adipisci ab accusantium quisquam voluptates eveniet! Quia deleniti inventore totam.</p>'
            ]
        );
        Post::create(
            [
                'user_id' => $user->id,
                'category_id' => $work->id,
                'title' => 'My Work Post',
                'slug' => 'my-work-post',
                'excerpt' => 'Exerpt of the post',
                'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, minima modi sit iure aperiam dicta quas ea ratione, similique praesentium adipisci ab accusantium quisquam voluptates eveniet! Quia deleniti inventore totam.</p>'
            ]
        );

        */
    }
}
