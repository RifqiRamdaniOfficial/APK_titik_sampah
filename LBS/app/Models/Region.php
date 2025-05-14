<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function reqs(){
        return $this->hasMany(Req::class); 
    }

    public function laporanDibersihkanPerWil()
{
    return $this->reqs()->where('status', 'sudah dibersihkan')->count();
}

public function cleanedReqs()
{
    return $this->reqs()->where('status', 'cleaned'); 
}

}
