<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable; //slugble slug otomatis yang harus di download dulu di compouser


class Post extends Model
{
    use HasFactory, Sluggable;

    //data yang hanya boleh di isi sisanya otomatis
    // protected $fillable = ['title', 'excerpt', 'body']; 

    //data yang tidak boleh di isi adalah id sisanya boleh
    protected $guarded = ['id'];

    //with untuk eager loading untuk mengatasi N+1
    protected $with = ['category', 'user'];

    //membuat fungsi search dengan scope
    public function scopeFilter($query, array $filters)
    {
        // if (Request('search')) {
        //     //'%' . . '%' mencari data apapun yang mengandung kata tersebut didalam title
        //     return $query->where('title', 'like', '%' . request('search') . '%')

        //         // atau mencari data yang mengandung kata tersebut didalam body
        //         ->orWhere('body', 'like', '%' . request('search') . '%');
        // }
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['user'] ?? false, function ($query, $user) {
            return $query->whereHas('user', function ($query) use ($user) {
                $query->where('username', $user);
            });
        });
    }

    //membuat relasi dengan model category
    public function category()
    {
        return $this->belongsTo(Category::class); //satu postingan dimiliki 1 ketegori
    }

    public function user()
    {
        return $this->belongsTo(User::class); //satu postingan ditulis 1 user
    }

    public function getRouteKeyName()
    {
        return 'slug'; //mengaklai resouce dashboard controller agar menggunakan slug bukan id
    }

    public function sluggable(): array //slug otomatis
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
