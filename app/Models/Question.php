<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable=['quiz_id','order','question_title','image','chose1','chose2','chose3','chose4','answer'];

    protected $casts = ['image'=>'array'];

    public function Quiz()
    {// 'App\Models\Quiz'
        return $this->belongsTo(Quiz::class);
    }

    public function GetCorrectAnswer()
    {
        return $this->answer;
    }
}
