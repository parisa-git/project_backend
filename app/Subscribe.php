<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    public function user(){
        return $this->belongsTo(user::class);
    }

    public function thread(){
        return $this->belongsTo(thread::class);
    }
}
