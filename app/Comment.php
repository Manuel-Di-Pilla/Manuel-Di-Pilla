<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name',
        'text',
        'updated_at',
        'creadet_at',
        'post_id'
    ];

    public function post() {
        return $this->belongsTo('App\Post'); 
    }
}
