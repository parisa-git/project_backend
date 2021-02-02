<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function channel(){
        return $this->belongsTo(channel::class);
    }

    public function user(){
        return $this->belongsTo(user::class);
    }

    public function answers(){
        return $this->hasMany(answers::class);
    }
}
