<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable=['kurum_id','quiz_uniqe_id','fullname','email','phone','ip','answers'];

    public function Quiz()
    {// 'App\Models\User'
        return $this->belongsTo(Quiz::class);// git push test
    }
    public function Kurum()
    {// 'App\Models\User'
        return $this->belongsTo(Kurum::class);// git push test
    }
}
