<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable=['title','description','user_id','status'];

    //one to many
    public function answers(){

        return $this->hasMany(Answer::class,'question_id','id');

    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function tags(){

        return $this->belongsToMany(
            Tag::class, //Related modle
            'question_tag', //Pivot table
            'question_id', //FK for current modle in pivot table
            'tag_id', //FK for related modle in pivot table
            'id', //PK for current modle
            'id' //PK for related modle

        );
    }

}
