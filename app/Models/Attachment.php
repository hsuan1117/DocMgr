<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    public function doc(){
        return $this->belongsTo(Doc::class);
    }
}
