<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images_rooms extends Model
{
    use HasFactory;

    protected $connection = 'db_hotel_connection';
    protected $table = 'images_rooms';
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'code',
        'room_types_code',
        'url',
    ];

    public function RoomType()
    {
        return $this->belongsTo(Room_types::class, 'room_types_code', 'code');
    }
}
