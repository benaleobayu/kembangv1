<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\Regency;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRiderRequest;
use App\Http\Requests\UpdateRiderRequest;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('riders.ridersIndex',[
            'data' => Rider::orderBy('updated_at', 'desc')->filters(request(['search']))->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('riders.ridersCreate',[
            'regency' => Regency::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRiderRequest $request)
    {
        $createRiders = $request->validate([
            'name' => 'required|max:30',
            'address' => 'required|max:255',
            'regencies_id' => 'required',
            'phone' => 'required|numeric|min:3',
            'dob' => 'nullable|date'
        ]);

        Rider::create($createRiders);

        return redirect('/riders')->with('success', 'Data Rider berhasil ditambahkan !');

    }

    /**
     * Display the specified resource.
     */
    public function show(Rider $rider)
    {
        // $data = $rider->find($id);
        return view ('riders.ridersShow',[
            'data' => $rider,
            'regency' => Regency::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rider $rider)
    {
        return view ('riders.ridersEdit',[
            'data' => $rider,
            'regency' => Regency::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRiderRequest $request, Rider $rider)
    {
        
        $updateRiders = $request->validate([
            'name' => 'required|max:30',
            'address' => 'required|max:255',
            'regencies_id' => 'required',
            'phone' => 'required|numeric|min:3',
            'dob' => 'nullable|date'
        ]);

        $updateRiders['updated_at'] = now();

        Rider::where('id', $rider->id)->update($updateRiders);

        return redirect('/riders')->with('success', 'Data Rider berhasil diupdate !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rider $rider)
    {
        Rider::destroy($rider->id);
        return redirect('/riders')->with('success', 'Data Rider berhasil dihapus !');

    }
}
