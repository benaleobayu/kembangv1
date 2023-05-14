<?php

namespace App\Http\Controllers;

use App\Models\Langganan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLanggananRequest;
use App\Models\Customers;
use App\Models\Day;
use App\Models\Flowers;
use App\Models\Regency;

class LanggananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if (!empty($search)) {
            $query = Langganan::where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('')
                ->paginate(10)->withQueryString();
        } else {
            $query = Langganan::orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        }

        return view('customers.langgananIndex', [
            'data' => $query,
            'search' => $search
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.langgananCreate', [
            'data' => Customers::orderBy('name', 'asc')->get(),
            'regency' => Regency::orderBy('name', 'asc')->get(),
            'flowers' => Flowers::orderBy('name', 'asc')->get(),
            'day' => Day::orderBy('name', 'asc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Langganan = new Langganan;

        // Ambil data dari tabel 1 berdasarkan nama atau nomor telephone
        $Customers = Customers::where('name', $request->input('name'))->first();

        // Masukkan data ke tabel 2
        $Langganan->name = $Customers->name;
        $Langganan->address = $Customers->address;
        $Langganan->phone = $Customers->phone;
        $Langganan->notes = $Customers->notes;
        $Langganan->regencies_id = $Customers->regencies_id;
        $Langganan->flowers_id = $request->input('flowers_id');
        $Langganan->total = $request->input('total');
        $Langganan->day_id = $request->input('day_id');
        $Langganan->pic = 'Priska';

        $Langganan->save();

        return redirect('/subscribers')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Langganan $langganan, $id)
    {
        $data = $langganan->find($id);
        return view('customers.langgananShow', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Langganan $langganan, $id)
    {
        $data = $langganan->find($id);
        return view('customers.langgananEdit', [
            'data' => $data,
            'regency' => Regency::orderBy('name', 'asc')->get(),
            'flowers' => Flowers::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Langganan $langganan, $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'address' => 'required|max:255',
            'regencies_id' => 'required',
            'phone' => 'numeric',
            'flowers_id' => 'numeric',
            'total' => 'numeric',
            'notes' => 'max:255',
            'day' => 'required'
        ]);

        $validateData['pic'] = auth()->user()->name;

        Langganan::where('id', $id)->update($validateData);

        return redirect('/subscribers')->with('success', 'Data Langganan berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Langganan $langganan)
    {
        //
    }
}
