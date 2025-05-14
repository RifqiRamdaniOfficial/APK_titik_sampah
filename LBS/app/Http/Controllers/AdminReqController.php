<?php

namespace App\Http\Controllers;

use App\Models\Req;
use App\Models\Region;
use Illuminate\Http\Request;

class AdminReqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin_reqs.index', [
            'reqs' => Req::latest()->filter()->paginate(10)
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'image' => 'image|file|max:1024',
            'addres' => 'required|max:244',
            'slug'  => 'required|unique:reqs',
            'region_id' => 'required',
            'information' => 'required'
        ]);

        $validatedData['image'] = $request->file('image')->store('post-images');

        $validatedData['user_id'] = auth()->user()->id;

        Req::create($validatedData);

        return redirect('/dashboard/admin_reqs')->with('success', 'Berhasil Membuat Pengajuan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Req  $req
     * @return \Illuminate\Http\Response
     */
    public function show(Req $req)
    {
        return view('dashboard.admin_reqs.show',[
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
        return view('dashboard.admin_reqs.edit', [
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
       
        Req::where('id', $req->id)
            ->update($validatedData);

        return redirect('/dashboard')->with('success', 'Pengajuan Telah Diubah!');
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

        return redirect('/dashboard/admin_reqs')->with('success', 'Berhasil Menghapus Pengajuan');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Req::class, 'slug', $request->addres);
        return response()->json(['slug' => $slug]);
    }

    
}
