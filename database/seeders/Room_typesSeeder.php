<?php

namespace Database\Seeders;

use App\Models\Images_rooms;
use App\Models\Room_types;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Room_typesSeeder extends Seeder
{
    protected $model = Room_types::class;
    protected $connection ='db_hotel_connection';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room_types::create([
            'code' => 'REG',
            'name' => 'Regular',
        ]);

        Room_types::create([
            'code' => 'DLX',
            'name' => 'Deluxe',
        ]);

        Room_types::create([
            'code' => 'TWN',
            'name' => 'Twin Room',
        ]);

        Room_types::create([
            'code' => 'SUP',
            'name' => 'Super',
        ]);

        Room_types::create([
            'code' => 'LTD',
            'name' => 'Limited Edition',
        ]);

        $listRoomTypes = Room_types::all();

        $code = 1;
        foreach ($listRoomTypes as $type) {
            $formattedCode = 'IR' . str_pad($code, 3, '0', STR_PAD_LEFT);

            Images_rooms::create([
                'code' => $formattedCode,
                'room_type_code' => $type->code,
                'url' => 'https://picsum.photos/seed/' . $type->code . '/200/300',
            ]);

            $code++;
        }
    }
}
