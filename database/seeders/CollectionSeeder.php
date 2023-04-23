<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        $collections = [
            [
                'category_id'=> 1,
                'user_id'=> rand(1,2),
                'name'=> 'Back-end #1',
                'description'=> 'Bul kolleksiyada back-end ke tiyisli eń ańsat sorawlar jaylasqan.',
                'code'=> Str::random('6'),
                'allowed_type'=> 'public',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'category_id'=> 2,
                'user_id'=> rand(1,2),
                'name'=> 'Front-end #1',
                'description'=> 'Bul kolleksiyada front-end ke tiyisli eń ańsat sorawlar jaylasqan.',
                'code'=> Str::random('6'),
                'allowed_type'=> 'url',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ];

        DB::table('collections')->insert($collections);
    }
}
