<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Flowers;
use App\Models\Langganan;
use App\Models\Regency;
use Illuminate\Http\Request;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if(!empty($search)){
            $query = Day::where('name', 'like', '%' . $search . '%')
                    ->whereBetween('id', [2,8])
                    ->orderBy('id', 'asc')->paginate(10)->withQueryString();
        }else{
            $query = Day::whereBetween('id', [2,8])->orderBy('id', 'asc')->paginate(10)->withQueryString();
        }

        return view('customers.dayIndex',[
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
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'slug' => 'nullable',
            'date' => 'required'
        ]);

        Day::create($validateData);

        return redirect('/daysubscribs')->with('success', 'Data berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Day $day, $slug)
    {
        $query = $day->where('slug', $slug)->firstOrFail()->langganan();

        $search = $request->query('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        $dates = $query->paginate(10)->withQueryString();

        return view('customers.dayOnIndex',[
            'data' => $dates,
            'search' => $search,
            'slug' => $slug
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Day $day, $id)
    {
        $data = $day->find($id);
        return view('customers.dayEdit',[
            'data' => $data,
            'onSlug' => 'daysubscribs'
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

        return redirect('/daysubscribs')->with('success', 'Nama hari langganan berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     */
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

    public function showEdit($id)
    {
        $langganans = Langganan::findOrFail($id);


        if (!$langganans) {
            return redirect('/subscribers')->with('error', 'Data tidak ditemukan !');
        }

        $pesanans = $langganans->pesanans ?? [];
        $data = [
            'data' => $langganans,
            'flowers' => Flowers::orderBy('name', 'asc')->get(),
            'regency' => Regency::orderBy('name', 'asc')->get(),
            'day' => Day::whereBetween('id', [1, 8])->orderBy('id', 'asc')->get(),
            'pesanans' => $pesanans
            // ... tambahkan data lain yang diperlukan ...
        ];
        return view('customers.langgananEdit', $data);
    }

    public function showUpdate(Request $request, Langganan $langganan, $id)
    {

        $subscriber = Langganan::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'regencies_id' => 'required|exists:regencies,id',
            'day_id' => 'required|exists:days,id',
            'notes' => 'nullable|string',
            'pesanans' => 'nullable|array',
            'pesanans.*.flowers_id' => 'required|exists:flowers,id',
            'pesanans.*.total' => 'required|integer',
        ]);

        $subscriber->name = $request->name;
        $subscriber->phone = $request->phone;
        $subscriber->address = $request->address;
        $subscriber->regencies_id = $request->regencies_id;
        $subscriber->day_id = $request->day_id;
        $subscriber->notes = $request->notes;
        $subscriber->pic = auth()->user()->name;

        $subscriber->pesanans()->delete();

        if ($request->has('pesanans')) {
            foreach ($request->pesanans as $pesanan) {
                $subscriber->pesanans()->create([
                    'flowers_id' => $pesanan['flowers_id'],
                    'total' => $pesanan['total'],
                ]);
            }
        }

        $subscriber->save();

        return redirect('/daysubscribs' )->with('success', 'Data pelanggan berhasil diperbarui.');
    }
}
