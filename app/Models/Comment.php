<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id', 'user_id', 'comment_content'
    ];

    public function comentator(){
        // user_id adalah foreignkey di table comment dan id adalah primary key di tabel user
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
