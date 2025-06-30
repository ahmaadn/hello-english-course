<?php

namespace Database\Seeders;

use App\Models\Genre;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Materi;
use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // ADMIN
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // GENRE
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

        $modulData = [
            [
                'name' => 'Introduction to English',
                'description' => 'Basic concepts and introduction to English language.',
                'image_url' => 'https://dummyimage.com/600x400/000/fff&text=Introduction+to+English',
                'estimated' => 120,
                'order' => 1
            ],
            [
                'name' => 'Grammar Essentials',
                'description' => 'Fundamental grammar rules and usage.',
                'image_url' => 'https://dummyimage.com/600x400/000/fff&text=Grammar+Essentials',
                'estimated' => 120,
                'order' => 2
            ],
            [
                'name' => 'Vocabulary Building',
                'description' => 'Techniques and exercises to expand vocabulary.',
                'image_url' => 'https://dummyimage.com/600x400/000/fff&text=Vocabulary+Building',
                'estimated' => 120,
                'order' => 3
            ],
        ];

        foreach ($modulData as $modul) {
            Module::create([
                'name' => $modul['name'],
                'slug' => strtolower(str_replace(' ', '-', $modul['name'])),
                'description' => $modul['description'],
                'image_url' => $modul['image_url'],
                'estimated' => $modul['estimated'],
                'order' => $modul['order'],
                'user_id' => 1
            ]);
        }

        $materiData = [
            [
                'modul_id' => 1,
                'title' => 'What is English?',
                'content' => 'An overview of the English language and its history.',
                'illustrations_url' => 'https://dummyimage.com/600x400/007bff/fff&text=What+is+English',
                'order' => 1,
            ],
            [
                'modul_id' => 1,
                'title' => 'Why Learn English?',
                'content' => 'The importance and benefits of learning English.',
                'illustrations_url' => 'https://dummyimage.com/600x400/28a745/fff&text=Why+Learn+English',
                'order' => 2
            ],
            [
                'modul_id' => 2,
                'title' => 'Parts of Speech',
                'content' => 'Introduction to nouns, verbs, adjectives, and more.',
                'illustrations_url' => 'https://dummyimage.com/600x400/ffc107/000&text=Parts+of+Speech',
                'order' => 1
            ],
            [
                'modul_id' => 2,
                'title' => 'Tenses',
                'content' => 'Understanding present, past, and future tenses.',
                'illustrations_url' => 'https://dummyimage.com/600x400/dc3545/fff&text=Tenses',
                'order' => 2
            ],
            [
                'modul_id' => 3,
                'title' => 'Common Words',
                'content' => 'A list of frequently used English words.',
                'illustrations_url' => 'https://dummyimage.com/600x400/17a2b8/fff&text=Common+Words',
                'order' => 1
            ],
            [
                'modul_id' => 3,
                'title' => 'Word Formation',
                'content' => 'How new words are formed in English.',
                'illustrations_url' => 'https://dummyimage.com/600x400/6f42c1/fff&text=Word+Formation',
                'order' => 1
            ],
        ];

        foreach ($materiData as $materi) {
            Materi::create([
                'title' => $materi['title'],
                'content' => $materi['content'],
                'order' => $materi['order'],
                'slug' => Str::slug($materi['title']) . '-' . rand(1000, 9999),
                'illustrations_url' => $materi['illustrations_url'],
                'genre_id' => 1,
                'module_id' => $materi['modul_id'],
            ]);
        }

    }
}
