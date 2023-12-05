<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $connection = 'db_hotel_connection';
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
}
