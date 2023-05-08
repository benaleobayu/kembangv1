<?php

namespace App\Http\Controllers;

use App\Models\Regency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegencyRequest;
use App\Http\Requests\UpdateRegencyRequest;

class RegencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index (Request $request)
    {

        if(auth()->guest()){
            abort(403);
        }
        
        $search = $request->query('search');

        if (!empty($search)) {
            $query = Regency::where('name', 'like', '%' . $search . '%')
                            ->orWhere('city', 'like', '%' . $search . '%')
                            ->paginate(10)->withQueryString();
        } else {
            $query = Regency::orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        }

        return view('settings.regenciesIndex', [
            'data' => $query,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.regenciesCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'city' => 'required'
        ]);

        Regency::create($validateData);
        return redirect('/regencies')->with('success', 'Daerah berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Regency $regency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Regency $regency)
    {
        return view ('settings.regenciesEdit',[
            'data' => $regency
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Regency $regency)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'city' => 'required'
        ]);

        Regency::where('id', $regency->id)->update($validateData);
        return redirect('/regencies')->with('success', 'Daerah berhasil ditambahkan !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Regency $regency)
    {
        Regency::destroy($regency->id);

        return redirect('/regencies')->with('success', 'Daerah berhasil dihapus !');
    }
}
