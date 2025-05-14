<?php

namespace App\Http\Controllers;

use PDF; 
use App\Models\Req;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PDFController extends Controller
{
    public function exportPDF(Request $request)
    {
        
        $query = Req::query();

        
        if ($request->filled('date')) {
            $query->whereDate('publish_at', $request->date);
        }

        if ($request->filled('week')) {
            $query->whereRaw('WEEK(publish_at, 1) = ?', [$request->week]);
        }

        if ($request->filled('month')) {
            $month = Carbon::parse($request->month)->month;
            $query->whereMonth('publish_at', $month);
        }

        
        $reqs = $query->get();

        
        $pdf = PDF::loadView('dashboard.pdf', compact('reqs'));

        
        $pdf->setPaper('a4', 'landscape');

        
        return $pdf->download('laporan-titik-sampah.pdf');
    }
}
