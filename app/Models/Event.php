<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = ['date'];

    protected $guarded = [];

/* --- 1 - 1 event - user --- */
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

/* --- 1 - N user - event --- */
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
