<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasFactory;

    protected $connection = 'db_hotel_connection';
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'phone'
    ];

    public function Booking()
    {
        return $this->hasMany(Bookings::class, 'user_id', 'id');
    }

    public function Htrans()
    {
        return $this->hasMany(Htrans_hotel::class, 'user_id', 'id');
    }

    public function HotelReviews()
    {
        return $this->belongsToMany(Hotels::class, 'reviews', 'user_id', 'hotel_code')
            ->withPivot('id', 'stars', 'content', 'created_at', 'updated_at');
    }

    public function Favorites()
    {
        return $this->belongsToMany(Hotels::class, 'favorites', 'user_id', 'hotel_code')
            ->withPivot('id');
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}
