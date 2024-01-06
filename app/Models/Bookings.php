<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookings extends Model
{
    use HasFactory;

    protected $connection = 'db_hotel_connection';
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'room_code',
        'user_id',
        'start_date',
        'end_date',
    ];

    public function Room()
    {
        return $this->belongsTo(Rooms::class, 'room_code', 'code');
    }

    public function User()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }

    public function Dtrans()
    {
        return $this->belongsTo(Dtrans_hotel::class, 'booking_id', 'id');
    }
}
