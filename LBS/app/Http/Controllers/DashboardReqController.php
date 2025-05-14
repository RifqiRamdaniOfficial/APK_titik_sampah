<?php

namespace App\Http\Controllers;

use App\Models\Req;
use App\Models\Region;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;


class DashboardReqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 

        return view('dashboard.reqs.index', [
            'reqs' => Req::where('user_id', auth()->user()->id)->filter()->get() 
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.reqs.create', [
            'regions' => Region::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg', 
        'addres' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:reqs',
        'region_id' => 'required|exists:regions,id',
        'information' => 'required|string',
        'latitude' => 'nullable|string',
        'longitude' => 'nullable|string',
    ]);

    
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $validatedData['image'] = $imagePath;
    }

    
    Req::create([
        'image' => $validatedData['image'] ?? null,
        'addres' => $validatedData['addres'],
        'slug' => $validatedData['slug'],
        'region_id' => $validatedData['region_id'],
        'information' => $validatedData['information'],
        'latitude' => $validatedData['latitude'] ?? null,
        'longitude' => $validatedData['longitude'] ?? null,
        'status' => 'belum dibersihkan', 
        'user_id' => auth()->user()->id, 
    ]);

    
    return redirect('/dashboard')->with('success', 'Laporan berhasil dibuat!');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Req  $req
     * @return \Illuminate\Http\Response
     */
    public function show(Req $req)
    {
        return view('dashboard.reqs.show',[
            'req'=> $req
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Req  $req
     * @return \Illuminate\Http\Response
     */
    public function edit(Req $req)
    {
        return view('dashboard.reqs.edit', [
            'req' => $req,
            'regions' => Region::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Req  $req
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Req $req)
{
    $rules = [
        'addres' => 'required|max:255',
        'region_id' => 'required',
        'information' => 'required',
        'status' => 'required' 
    ];

    if ($request->slug != $req->slug) {
        $rules['slug'] = 'required|unique:reqs';
    }

    $validatedData = $request->validate($rules);
    $validatedData['user_id'] = auth()->user()->id;

    Req::where('id', $req->id)->update($validatedData);

    return redirect('/dashboard')->with('success', 'Pengajuan Telah Diproses!');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Req  $req
     * @return \Illuminate\Http\Response
     */
    public function destroy(Req $req)
    {
        Req::destroy($req->id);

        return redirect('/dashboard')->with('success', 'Berhasil Menghapus Pengajuan');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Req::class, 'slug', $request->addres);
        return response()->json(['slug' => $slug]);
    }

    public function tampil()
    { 

        return view('dashboard.reqs.wa');
    }
}
