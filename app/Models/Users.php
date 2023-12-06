<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $connection = 'db_hotel_connection';
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;

    public function Booking()
    {
        return $this->hasMany(Bookings::class, 'user_id', 'id');
    }

    public function Htrans()
    {
        return $this->hasMany(Htrans_hotel::class, 'user_id', 'id');
    }

    public function Review()
    {
        return $this->hasMany(Reviews::class, 'user_id', 'id');
    }
}
