<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Null_;

class Answer extends Model
{
    protected $fillable = [
        'body', 'user_id', 'question_id'
    ];
    // question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    // get Body Html Attribute
    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    // boot
    public static function boot()
    {
        parent::boot();

        // Increment Answers Count When Answer Was deleted
        static::created(function ($answer) {
            $answer->question->increment('answers_count');
        });


        // Decrement Answers Count When Answer Was deleted
        static::deleted( function ($answer) {
            $answer->question->decrement('answers_count');
        });
    }

    public function getStatusAttribute()
    {
        return $this->id == $this-> question->best_answer_id ? 'vote-accepted' : '';
    }
}

