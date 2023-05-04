<?php

namespace App\Http\Controllers;

use App\Models\Langganan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLanggananRequest;
use App\Http\Requests\UpdateLanggananRequest;

class LanggananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index (Request $request)
    {
        $search = $request->query('search');

        if (!empty($search)) {
            $query = Langganan::where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
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
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLanggananRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Langganan $langganan, $id)
    {
        $data = $langganan->find($id);
        return view ('customers.langgananShow',[
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Langganan $langganan)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLanggananRequest $request, Langganan $langganan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Langganan $langganan)
    {
        //
    }
}
