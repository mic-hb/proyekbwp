<?php

namespace App\Console\Commands;

use App\Models\Bookings;
use App\Models\Cities;
use App\Models\Dtrans_hotel;
use App\Models\Hotels;
use App\Models\Htrans_hotel;
use App\Models\Images_hotels;
use App\Models\Images_rooms;
use App\Models\Room_types;
use App\Models\Rooms;
use App\Models\Users;
use Illuminate\Console\Command;

class RunMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Jalanin migration dan seeder untuk database hotel sesuai urutan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $path = 'database/migrations/new/';
        // $this->call('migrate:rollback', [
        // '--database' => 'db_hotel_connection',
        // '--path' => $path ,
        // ]);

        /** Specify the names of the migrations files in the order you want to
         * loaded
         * $migrations =[
         *               'xxxx_xx_xx_000000_create_nameTable_table.php',
         *    ];
         */
        // $migrations = [
        //                 '2023_12_28_073724_create_bookings_table',
        //                 '2023_12_28_073724_create_cities_table',
        //                 '2023_12_28_073724_create_dtrans_hotel_table',
        //                 '2023_12_28_073724_create_favorites_table',
        //                 '2023_12_28_073724_create_hotels_table',
        //                 '2023_12_28_073724_create_htrans_hotel_table',
        //                 '2023_12_28_073724_create_images_hotels_table',
        //                 '2023_12_28_073724_create_images_rooms_table',
        //                 '2023_12_28_073724_create_reviews_table',
        //                 '2023_12_28_073724_create_room_types_table',
        //                 '2023_12_28_073724_create_rooms_table',
        //                 '2023_12_28_073724_create_users_table',
        //                 '2023_12_28_073727_add_foreign_keys_to_bookings_table.php',
        //                 '2023_12_28_073727_add_foreign_keys_to_dtrans_hotels_table.php',
        //                 '2023_12_28_073727_add_foreign_keys_to_favorites_table.php',
        //                 '2023_12_28_073727_add_foreign_keys_to_hotels_table.php',
        //                 '2023_12_28_073727_add_foreign_keys_to_htrans_hotels_table.php',
        //                 '2023_12_28_073727_add_foreign_keys_to_images_hotels_table.php',
        //                 '2023_12_28_073727_add_foreign_keys_to_images_rooms_table.php',
        //                 '2023_12_28_073727_add_foreign_keys_to_reviews_table.php',
        //                 '2023_12_28_073727_add_foreign_keys_to_rooms_table.php',
        // ];

        // foreach($migrations as $migration)
        // {
        //    $basePath = 'database/migrations/new/';
        // //    $migrationName = trim($migration);
        //    $path = $basePath.$migration;
        //    $this->call('migrate', [
        //     '--database' => 'db_hotel_connection',
        //     '--path' => $path ,
        //    ]);
        // }

        // Images_rooms::truncate();
        // Images_hotels::truncate();
        // Dtrans_hotel::truncate();
        // Bookings::truncate();
        // Htrans_hotel::truncate();
        // Users::truncate();
        // Rooms::truncate();
        // Room_types::truncate();
        // Hotels::truncate();
        // Cities::truncate();


        $this->call('migrate:fresh', [
            '--database' => 'db_hotel_connection',
            '--path' => 'database/migrations/new',
        ]);

        $seeders = [
            'CitySeeder',
            'HotelsSeeder',
            'Room_typesSeeder',
            'RoomsSeeder',
            'UsersSeeder',
            'TransactionSeeder',
            'FavoritesSeeder',
            'ReviewsSeeder',
        ];

        foreach ($seeders as $seed) {
            $this->call('db:seed', [
                '--class' => $seed,
            ]);
        }
    }
}
