<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Htrans_hotel extends Model
{
    use HasFactory;

    protected $connection = 'db_hotel_connection';
    protected $table = 'htrans_hotel';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
}
