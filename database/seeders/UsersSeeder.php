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
            'password' => bcrypt('admin'),
            // 'password' => '$2y$12$8U5E1PXMc9GoxLAMuC.rIezCnsY1cFpPVYD6c.RlEynMpXzvlAdMq',
            'phone' => '0812345678',
            'role' => 0,
        ]);
        Users::create([
            'id' => 'U001',
            'name' => 'Asep',
            'email' => 'asep@gmail.com',
            'password' => bcrypt('123'),
            // 'password' => '$2y$12$8Ez2ZZq1vc7ds9QTkDefzelzdz/Q4Z.xhWFEDoBz7CEuVtP7g9Rle',
            'phone' => '0812345678',
            'role' => 1,
        ]);
        Users::create([
            'id' => 'U002',
            'name' => 'Solihin',
            'email' => 'solihin@gmail.com',
            'password' => bcrypt('123'),
            // 'password' => '$2y$12$8Ez2ZZq1vc7ds9QTkDefzelzdz/Q4Z.xhWFEDoBz7CEuVtP7g9Rle',
            'phone' => '0812345678',
            'role' => 2,
        ]);
        Users::create([
            'id' => 'U003',
            'name' => 'RAFAEL',
            'email' => 'rafael@gmail.com',
            'password' => '$2y$12$LIm4nXmdTXk.4slzqCXpEefWPnRSj2dXBw1adoOD8R7Yn0rSQS5HS',
            'phone' => '082188888888',
            'role' => 1,
            'created_at' => '2024-01-02 19:10:08',
            'updated_at' => '2024-01-02 19:10:08',
        ]);
    }
}
