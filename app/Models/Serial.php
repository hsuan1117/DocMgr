<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Serial extends Model
{
    use HasFactory;
    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function docs(){
        return $this->hasMany(Doc::class);
    }


}
