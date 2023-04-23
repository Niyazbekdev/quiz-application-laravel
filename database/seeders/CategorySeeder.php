<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'=> 'Back-end',
            ],
            [
                'name'=> 'Front-end',
            ],
            [
                'name'=> 'Matematika',
            ],
            [
                'name'=> 'Fizika',
            ],
            [
                'name'=> 'Tariyx',
            ],
        ];
        DB::table('categories')->insert($categories);
    }
}
