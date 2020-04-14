<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $fillable = [
        'user_id',
        'name',
        'description',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
