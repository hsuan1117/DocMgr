<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Doc extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function serial(){
        return $this->hasOne(Serial::class);
    }

    public function attachments(){
        return $this->hasMany(Attachment::class);
    }

    protected $fillable = [
        'serial_number', //發文 號
        'date', //發文日期
        'receiver', //受文者
        'speed', //速別
        'confidentiality', //密等

        'subject', //主旨
        'explanation', //說明
    ];

    protected $casts = [
        'attachment' => 'array'
    ];
}
