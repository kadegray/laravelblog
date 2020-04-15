<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    public $fillable = [
        'user_id',
        'name',
        'description',
        'body',
        'header_image',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
