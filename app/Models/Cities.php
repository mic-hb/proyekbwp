<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;

    protected $connection = 'db_hotel_connection';
    protected $table = 'cities';
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $timestamps = false;
}
