<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
