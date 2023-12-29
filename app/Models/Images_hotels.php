<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images_hotels extends Model
{
    use HasFactory;

    protected $connection = 'db_hotel_connection';
    protected $table = 'images_hotels';
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'code',
        'hotel_code',
        'url',
    ];

    public function Hotel()
    {
        return $this->belongsTo(Hotels::class, 'hotel_code', 'code');
    }
}
