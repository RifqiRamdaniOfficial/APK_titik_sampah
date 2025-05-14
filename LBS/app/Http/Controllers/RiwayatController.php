<?php

namespace App\Http\Controllers;
use App\Models\Req;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = Auth::user();
        
        $reqs = Req::where('user_id', $user->id)
                    ->where('status', 'sudah dibersihkan')
                    ->when($search, function ($query, $search) {
                        return $query->where('addres', 'like', '%' . $search . '%')
                                     ->orWhere('region_id', 'like', '%' . $search . '%');
                    })
                    ->paginate(10);
    
        return view('dashboard.riwayat.index', [
            'reqs' => $reqs
        ]);
    }
}
