<?php

namespace App\Http\Controllers;
use App\Models\Req;
use App\Models\Region;
use Illuminate\Http\Request;

class DaftarTugasController extends Controller
{
    public function index(Request $request)
    {
        $reqs = Req::latest();

        if (request('search')) {
            $reqs->where('region_id', 'like', '%' . request('search') . '%')
                ->orWhere('addres', 'like', '%' . request('search') . '%');
        }

        $status = $request->input('status', 'belum dibersihkan');
        return view('dashboard.tugas.index', [
            'reqs' => $reqs->where('status', $status)->paginate(10)
        ]);
       
        
    }
}

