<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    // atributos rellenables
    protected $fillable = ['body', 'user_id'];

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

    public function getStatusAttribute ()
    {
        return $this->id === $this->question->best_answer_id ? 'vote-accepted' : '';
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

        static::deleted( function ($answer) {
            $answer->question->decrement('answers_count');
        });

        // static::saved( function($answer) {
        //     echo "Answer\n";
        // });      
    }
}
