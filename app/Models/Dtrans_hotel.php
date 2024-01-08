<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dtrans_hotel extends Model
{
    use HasFactory;

    protected $connection = 'db_hotel_connection';
    protected $table = 'dtrans_hotel';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'htrans_id',
        'booking_id',
        'subtotal',
    ];

    public function Htrans()
    {
        return $this->belongsTo(Htrans_hotel::class, 'htrans_id', 'id');
    }

    public function Booking()
    {
        return $this->hasOne(Bookings::class, 'booking_id', 'id');
    }
}
