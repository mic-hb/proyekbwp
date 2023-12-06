<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $connection = 'db_hotel_connection';
    protected $table = 'rooms';
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $timestamps = false;

    public function Hotel()
    {
        return $this->belongsTo(Hotels::class, 'hotel_code', 'code');
    }

    public function Booking()
    {
        return $this->hasMany(Bookings::class, 'room_code', 'code');
    }
}
