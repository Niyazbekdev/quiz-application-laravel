<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'collection_id'=> 1,
                'question'=> 'Back-end qaysi dastirlew tillerinde jaziladi?',
                'correct_answers'=> 1,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'collection_id'=> 1,
                'question'=> 'Back-end kod qay jaqta isleydi?',
                'correct_answers'=> 1,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'collection_id'=> 2,
                'question'=> 'Front-end kod qay jaqta isleydi?',
                'correct_answers'=> 1,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'collection_id'=> 2,
                'question'=> 'Front-end qaysi dastirlew tillerinde jaziladi?',
                'correct_answers'=> 1,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ];

        DB::table('questions')->insert($questions);
    }
}
