<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotels extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'db_hotel_connection';
    protected $table = 'hotels';
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ["code", "city_code", "name", "address"];

    public function City()
    {
        return $this->belongsTo(Cities::class, 'city_code', 'code');
    }

    public function Rooms()
    {
        return $this->hasMany(Rooms::class, 'hotel_code', 'code');
    }

    public function UserReviews()
    {
        return $this->belongsToMany(Users::class, 'reviews', 'hotel_code', 'user_id')
            ->withPivot('id', 'stars', 'content', 'created_at', 'updated_at');
    }

    public function UserFavorites()
    {
        return $this->belongsToMany(Users::class, 'favorites', 'hotel_code', 'user_id')
            ->withPivot('id');
    }

    public function Images()
    {
        return $this->hasMany(Images_hotels::class, 'hotel_code', 'code');
    }

    protected $casts = [
        'image_urls' => 'json',
        'transactions' => 'json',
        'user' => 'json',
        'details' => 'json',
    ];

    public function getImagesAttribute()
    {
        return $this->Images()->pluck('url')->toArray();
    }

    // public function getTransactionAttribute()
    // {
    //     return $this->Images()->pluck('url')->toArray();
    // }
}
