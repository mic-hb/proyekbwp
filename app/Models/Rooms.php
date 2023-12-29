<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rooms extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'db_hotel_connection';
    protected $table = 'rooms';
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $timestamps = true;

    public function Hotel()
    {
        return $this->belongsTo(Hotels::class, 'hotel_code', 'code');
    }

    public function Booking()
    {
        return $this->hasMany(Bookings::class, 'room_code', 'code');
    }

    public function Type()
    {
        return $this->belongsTo(Room_types::class, 'room_types_code', 'code');
    }
}
