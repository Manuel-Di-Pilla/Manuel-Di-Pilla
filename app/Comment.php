<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name',
        'text',
        'updated_at',
        'created_at',
        'post_id'
    ];

    public function post() {
        return $this->belongsTo('App\Post'); 
    }
}
