<?php

namespace App\Http\Controllers;

use App\Models\Req;
use App\Models\Region;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return $this->generateReportView();
    }

    public function filterReports(Request $request)
    {
        return $this->generateReportView($request);
    }

    private function generateReportView(Request $request = null)
    {
        
        $reqQuery = Req::query();
        $regionQuery = Region::query();

        if ($request) {
            if ($request->filled('date')) {
                $reqQuery->whereDate('publish_at', $request->date);
            }

            if ($request->filled('week')) {
                $reqQuery->whereRaw('WEEK(publish_at, 1) = ?', [$request->week]);
            }

            if ($request->filled('month')) {
                $month = Carbon::parse($request->month)->month;
                $reqQuery->whereMonth('publish_at', $month);
            }
        }

        
        $totalRequests = (clone $reqQuery)->count();
        $completedRequests = (clone $reqQuery)->where('status', 'sudah dibersihkan')->count();
        $pendingRequests = (clone $reqQuery)->where('status', 'belum dibersihkan')->count();
        $totalWilayah = $regionQuery->count();

        
        $regions = $regionQuery->with(['reqs' => function ($query) use ($reqQuery) {
            $query->whereIn('id', $reqQuery->pluck('id'))->select('id', 'region_id', 'publish_at');
        }])->withCount([
            'reqs' => function ($query) use ($reqQuery) {
                $query->whereIn('id', $reqQuery->pluck('id'));
            },
            'reqs as cleaned_reqs_count' => function ($query) use ($reqQuery) {
                $query->whereIn('id', $reqQuery->pluck('id'))->where('status', 'sudah dibersihkan');
            }
        ])->get()->map(function ($region) {
            $total = $region->reqs_count;
            $cleaned = $region->cleaned_reqs_count;

            if ($total === $cleaned) {
                $region->status_indicator = 'bg-success'; 
            } elseif ($cleaned > 0) {
                $region->status_indicator = 'bg-warning'; 
            } else {
                $region->status_indicator = 'bg-danger'; 
            }

            return $region;
        });

       
        return view('dashboard.reports.index', [
            'totalRequests' => $totalRequests,
            'completedRequests' => $completedRequests,
            'pendingRequests' => $pendingRequests,
            'regions' => $regions,
            'totalWilayah' => $totalWilayah
        ]);
    }
}
