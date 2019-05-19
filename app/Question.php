<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property mixed slug
 */
class Question extends Model
{
    protected $fillable = [
        'title', 'body'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute ($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getUrlAttribute()
    {
        return route('questions.show', $this->slug);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        if ( $this->answers_count > 0 ) {
            if ( $this->best_answer_id ) {
                return 'answered-accepted';
            }
            return 'answered';
        }
        return 'unanswered';
    }

    public function getDescriptionHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->description);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function favourites()
    {
        $this->belongsToMany(User::class, 'favourites')->withTimestamps();
    }

    public function isFavourites()
    {
        return $this->favourites()->where('user_id', auth()->id())->count() > 0;
    }

    public function getIsFavouritesAttribute()
    {
        return $this->isFavourites();
    }

    public function getFavouritesCountAttribute()
    {
        return $this->Favourites->count();
    }
}
