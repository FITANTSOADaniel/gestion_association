<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $fillable = ['file_path', 'description', 'post_id'];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public static function createDocument($data)
    {
        if (isset($data['fichier'])) {
            $filePath = $data['fichier']->store('documents', 'public');
            $data['file_path'] = $filePath;
        }

        return self::create($data);
    }
}
