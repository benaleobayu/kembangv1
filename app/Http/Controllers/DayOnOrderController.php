<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Http\Request;

class DayOnOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.dayCreate', [
            'onSlug' => 'day',
            'days' => Day::whereBetween('id', [1, 8])->orderBy('id', 'asc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'slug' => 'nullable',
            'date' => 'nullable'
        ]);

        Day::create($validateData);

        return redirect('/orders')->with('success', 'Data Hari berhasil dibuat !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Day $day)
    {
    //    
    }

    /**
     * Show the form for editing the specified resource.
     */
    
    public function edit(Day $day, $id)
    {
        $data = $day->find($id);
        return view('customers.dayEdit',[
            'data' => $data,
            'onSlug' => 'day'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'slug' => 'nullable',
            'date' => 'nullable'
        ]);

        Day::where('id', $id)->update($validateData);

        return redirect('/orders')->with('success', 'Data berhasil diubah !');
    }

    public function destroy(Day $day, $id)
    {
        $deleted = Day::find($id);

        if ($deleted) {
            Day::destroy($id);
            session()->flash('success', 'Data berhasil dihapus !');
        } else {
            session()->flash('error', 'Data tidak ditemukan !');
        }
    }
}
