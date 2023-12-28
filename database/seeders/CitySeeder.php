<?php

namespace Database\Seeders;

use App\Models\Cities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    protected $model = Cities::class;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cities::factory(10)->create();
    }
}
