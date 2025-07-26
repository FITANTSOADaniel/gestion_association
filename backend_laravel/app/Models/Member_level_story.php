<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member_level_story extends Model
{
    use HasFactory;

    protected $fillable = [
        'level_id',
        'member',
        'status',
        'date',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'member');
    }

    public function level(){
        return $this->belongsTo(Level::class, 'level_id');
    }
}
