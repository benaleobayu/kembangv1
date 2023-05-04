<?php

namespace App\Http\Controllers;

use App\Models\Flowers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFlowersRequest;
use App\Http\Requests\UpdateFlowersRequest;

class FlowersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        if (!empty($search)) {
            $query = Flowers::where('code', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%')
                ->paginate(10)->withQueryString();
        } else {
            $query = Flowers::orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        }

        return view('settings.flowersIndex', [
            'data' => $query,
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('settings.flowersCreate', []);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'price' => 'numeric'
        ]);

        Flowers::create($validateData);
        return redirect('/flowers')->with('success', 'Data bunga berhasil ditambahkan !');
    }

    public function show(Flowers $flowers)
    {
        //
    }

    public function edit(Flowers $flowers, $id)
    {
        $data = $flowers->find($id);
        return view('settings.flowersEdit', [
            'data' => $data
        ]);
    }

    public function update(Request $request, Flowers $flowers, $id)
    {

        $validateData = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'price' => 'numeric'
        ]);

        Flowers::where('id', $id)->update($validateData);
        return redirect('/flowers')->with('success', 'Data bunga berhasil diubah !');
    }

    public function destroy(Flowers $flowers, $id)
    {
        Flowers::destroy($id);
        return redirect('/flowers')->with('success', 'Data bunga berhasil dihapus !');
    }
}
