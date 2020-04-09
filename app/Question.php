<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    //
    protected $fillable = ['title', 'body'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug']  = Str::slug($value);
    }    


    // Relaciones ....................................
    public function answers ()
    {
        return $this->hasMany(Answer::class);
        // $question->answers()->count();
        // foreach($question->answers() as $answer)
    }

    // Accesores .....................................
    public function getUrlAttribute ()
    {
        // return route("questions.show", $this->id);
        return route("questions.show", $this->slug);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute () 
    {
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }

    /**
     * Definiendo un nuevo accesor
     */
    public function getBodyHtmlAttribute() 
    {
        return \Parsedown::instance()->text($this->body);
    }
}
