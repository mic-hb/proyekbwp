<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    use HasFactory;

    protected $connection = 'db_hotel_connection';
    protected $table = 'hotels';
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $timestamps = false;

    public function City()
    {
        return $this->belongsTo(Cities::class, 'city_code', 'code');
    }

    public function UserReviews()
    {
        return $this->belongsToMany(Users::class, 'reviews', 'hotel_code', 'user_id')
        ->withPivot('id','stars','content');
    }
}
