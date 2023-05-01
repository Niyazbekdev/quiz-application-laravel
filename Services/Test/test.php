<?php

namespace App\..\Services\Test;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class test extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function rules(): array
    {
        return [];
    }

   public function execute(array $data): array
   {
       $this->validate($data)
       return $data;
   }
}
