<?php

namespace Database\Seeders;

use App\Models\Genre;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $genreData = [
            [
                'name' => 'Narrative',
                'description' => 'Text that tells about an event or incident.'
            ],
            [
                'name' => 'Exposition',
                'description' => 'Text that aims to explain information or knowledge.'
            ],
            [
                'name' => 'Descriptive',
                'description' => 'Text that describes an object, place, or event.'
            ],
            [
                'name' => 'Procedural',
                'description' => 'Text containing steps or procedures for doing something.'
            ],
            [
                'name' => 'Persuasive',
                'description' => 'Text that aims to persuade or convince the reader.'
            ],
        ];

        foreach ($genreData as $genre) {
            Genre::create([
                'name' => $genre['name'],
                'slug' => strtolower(str_replace(' ', '-', $genre['name'])),
                'description' => $genre['description']
            ]);
        }

    }
}
