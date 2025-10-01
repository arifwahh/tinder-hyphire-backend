<?php
// database/seeders/PersonSeeder.php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Picture;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    public function run(): void
    {
        $people = [
            [
                'name' => 'Emma Wilson',
                'age' => 25,
                'location' => 'New York',
                'latitude' => 40.7128,
                'longitude' => -74.0060,
                'like_count' => 75, // High like count for testing
                'pictures' => [
                    'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=400',
                    'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=400'
                ]
            ],
            [
                'name' => 'James Smith',
                'age' => 28,
                'location' => 'Los Angeles',
                'latitude' => 34.0522,
                'longitude' => -118.2437,
                'like_count' => 45, // Below threshold
                'pictures' => [
                    'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400',
                    'https://images.unsplash.com/photo-1519345182560-3f2917c472ef?w=400'
                ]
            ],
            [
                'name' => 'Sophia Johnson',
                'age' => 23,
                'location' => 'Chicago',
                'latitude' => 41.8781,
                'longitude' => -87.6298,
                'like_count' => 120, // High like count for testing
                'pictures' => [
                    'https://images.unsplash.com/photo-1534751516642-a1af1ef26a56?w=400',
                    'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=400'
                ]
            ],
            [
                'name' => 'Michael Brown',
                'age' => 30,
                'location' => 'Houston',
                'latitude' => 29.7604,
                'longitude' => -95.3698,
                'like_count' => 35, // Below threshold
                'pictures' => [
                    'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400',
                    'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?w=400'
                ]
            ],
            [
                'name' => 'Olivia Davis',
                'age' => 26,
                'location' => 'Miami',
                'latitude' => 25.7617,
                'longitude' => -80.1918,
                'like_count' => 60, // High like count for testing
                'pictures' => [
                    'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=400',
                    'https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?w=400'
                ]
            ]
        ];

        foreach ($people as $personData) {
            $person = Person::create([
                'name' => $personData['name'],
                'age' => $personData['age'],
                'location' => $personData['location'],
                'latitude' => $personData['latitude'],
                'longitude' => $personData['longitude'],
                'like_count' => $personData['like_count'],
            ]);

            foreach ($personData['pictures'] as $position => $url) {
                Picture::create([
                    'person_id' => $person->id,
                    'url' => $url,
                    'position' => $position
                ]);
            }
        }
    }
}