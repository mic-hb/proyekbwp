<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    protected $model = Users::class;
    protected $connection = 'db_hotel_connection';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Users::create([
            'id' => 'U000',
            'name' => 'Admin',
            'email' => 'admin',
            'password' => 'admin',
            'phone' => '0812345678',
            'role' => 0,
        ]);
        Users::create([
            'id' => 'U001',
            'name' => 'Asep',
            'email' => 'asep@gmail.com',
            'password' => '123',
            'phone' => '0812345678',
            'role' => 1,
        ]);
        Users::create([
            'id' => 'U002',
            'name' => 'Solihin',
            'email' => 'solihin@gmail.com',
            'password' => '123',
            'phone' => '0812345678',
            'role' => 2,
        ]);
    }
}
