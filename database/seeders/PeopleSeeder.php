<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeopleSeeder extends Seeder
{
    public function run(): void
    {
        // Insert sample people
        $personId = DB::table('people')->insertGetId([
            'name' => 'Alice Johnson',
            'age' => 25,
            'latitude' => -6.2000,
            'longitude' => 106.8167,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Add pictures for Alice
        DB::table('pictures')->insert([
            [
                'person_id' => $personId,
                'url' => 'https://example.com/pictures/alice1.jpg',
                'position' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'person_id' => $personId,
                'url' => 'https://example.com/pictures/alice2.jpg',
                'position' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Insert another person
        $personId2 = DB::table('people')->insertGetId([
            'name' => 'Bob Smith',
            'age' => 30,
            'latitude' => -6.9147,
            'longitude' => 107.6098,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('pictures')->insert([
            [
                'person_id' => $personId2,
                'url' => 'https://example.com/pictures/bob1.jpg',
                'position' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
