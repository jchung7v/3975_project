<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Event;
use App\Models\User;

class EventUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // $users = User::all();
        // $events = Event::all();

        // foreach ($events as $event) {
        //     $event->attendees()->attach(
        //         $users->random(rand(1, $users->count()))->pluck('id')->toArray()
        //     );
        // }
        $users = User::all();
        $events = Event::all();

        foreach ($events as $event) {
            // Get a random number of unique user IDs
            $userIds = $users->random(rand(1, $users->count()))->pluck('id')->unique();

            foreach ($userIds as $userId) {
                // Check if the user is already attached to the event
                if (!$event->attendees()->where('user_id', $userId)->exists()) {
                    $event->attendees()->attach($userId);
                }
            }
        }
    }
}
