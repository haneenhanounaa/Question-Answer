<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    public function questions(){

        return $this->belongsToMany(
            Question::class,
            'question_tag',
            'tag_id',
            'question_id',
            'id',
            'id'

        );
    }

}
