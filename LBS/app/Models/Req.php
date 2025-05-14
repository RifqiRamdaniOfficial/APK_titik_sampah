<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Req extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function scopeFilter($query)
    {

        if(request('search')){
            $query->where('region_id', 'like', '%'. request('search').'%')
                ->orWhere('addres', 'like', '%'. request('search').'%');
        }
    }


    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function user(){
        return $this->belongsTo(User::class); 
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function sluggable(): array 
    {
        return [
            'slug' => [
                'source' => 'addres'
            ]
        ];
    }
}
