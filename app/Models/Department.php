<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function serials(){
        return $this->hasMany(Serial::class);
    }
}
