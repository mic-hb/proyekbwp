<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_types extends Model
{
    use HasFactory;

    protected $connection = 'db_hotel_connection';
    protected $table = 'room_types';
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
    ];

    public function Rooms()
    {
        return $this->hasMany(Rooms::class, 'room_types_code', 'code');
    }

    public function Images()
    {
        return $this->hasMany(Images_rooms::class, 'room_types_code', 'code');
    }
}
