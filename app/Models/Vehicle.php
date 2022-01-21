<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DbModel;

class Vehicle extends Model
{
    use HasFactory, DbModel;

    protected $fillable = [
        'user_id',
        'plate',
        'model',
        'color',
        'type',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function isFromUserAuthenticated(){
        return $this->user_id == auth()->user()->id;
    }
}
