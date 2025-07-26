<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'member',
        'post',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'member');
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
