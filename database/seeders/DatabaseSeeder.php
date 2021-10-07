<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Vote;
use Database\Factories\VoteFactory;
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
        User::factory()->count(100)->hasPosts(5)->create()->each(function ($user) {
            foreach ($user->posts as $post) {
                $countOfVotes = random_int(10, 500);
                $post->votes()->saveMany(Vote::factory()->count($countOfVotes)->create([
                    'user_id' => $post->user_id,
                    'post_id' => $post->id
                ]));
            }
        });
    }
}
