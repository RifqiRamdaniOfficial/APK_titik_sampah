<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class DahsboardRegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.regions.index', [
            'regions' => Region::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.regions.create');
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
            'region_no' => 'required|unique:regions|digits:2',
            'name'  => 'required',
            'phone' => 'required|regex:(62)|min:10'
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        Region::create($validatedData);

        return redirect('/dashboard/regions')->with('success', 'Berhasil Menambah RW');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        return view('dashboard.regions.edit', [
            'region' => $region
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {

        $rules = [
            'name'  => 'required',
            'phone' => 'required|regex:(62)|min:10'
        ];

        
        if ($request->region_no != $region->region_no) {
            $rules['region_no'] = 'required|unique:reqs';
        }

        $validatedData = $request->validate($rules);


        Region::where('id', $region->id)
        ->update($validatedData);

        return redirect('/dashboard/regions')->with('success', 'Berhasil Menubah RW');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        Region::destroy($region->id);

        return redirect('/dashboard/regions')->with('success', 'Berhasil Menghapus RW');
    }
}
