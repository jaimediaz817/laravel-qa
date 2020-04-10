<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //

    // Relaciones ...................................
    public function question () {
        return $this->belongsTo(Question::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }


    /**
     * Definiendo un nuevo accesor
     */
    public function getBodyHtmlAttribute() 
    {
        return \Parsedown::instance()->text($this->body);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }


    // EVENTOS
    public static function boot ()
    {
        parent::boot();

        static::created( function ($answer) {
            // echo "Answer created\n";
            $answer->question->increment('answers_count');
            // $answer->question->save();
        });

        // static::saved( function($answer) {
        //     echo "Answer\n";
        // });      
    }
}
