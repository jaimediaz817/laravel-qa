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
}
