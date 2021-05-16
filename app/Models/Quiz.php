<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable=['quiz_title','kurum_id','quiz_description','quiz_status','quiz_finished_at','uniqe_id'];

    protected $dates=['finished_at'];

    // $post->user => User Model
    public function Kurum()
    {// 'App\Models\User'
        return $this->belongsTo(Kurum::class);// git push test
    }
    public function Questions(){
        return $this->hasMany(Question::class)->orderBy(\DB::raw('-`order`'), 'desc');
    }

}
