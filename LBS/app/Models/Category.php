<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id']; //hanya id yang tidak bisa di isi 

    public function posts()
    {
        return $this->hasMany(Post::class); //relasi dengan 1 category bisa dimiliki banyak post
    }
}
