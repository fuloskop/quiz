<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurum extends Model
{
    use HasFactory;

    //protected $table='kurumlar'; to company

    protected $fillable=['kurum_adi'];

    public $timestamps = false;

}
