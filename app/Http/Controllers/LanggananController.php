<?php

namespace App\Http\Controllers;

use App\Models\Langganan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Day;
use App\Models\Flowers;
use App\Models\Pesanan;
use App\Models\Regency;

class LanggananController extends Controller
{
    public function index(Request $request)
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
            'search' => $search,
            'dataName' => Customers::orderBy('name', 'asc')->get(),

        ]);
    }

    public function create()
    {
        return view('customers.langgananCreate', [
            'data' => Customers::orderBy('name', 'asc')->get(),
            'regency' => Regency::orderBy('name', 'asc')->get(),
            'flowers' => Flowers::orderBy('name', 'asc')->get(),
            'day' => Day::orderBy('id', 'asc')->get(),
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
        $Customers = Customers::where('name', $request->input('selectOption'))->first();


        // Masukkan data ke tabel 2
        $Langganan->name = $Customers->name;
        $Langganan->address = $Customers->address;
        $Langganan->phone = $Customers->phone;
        $Langganan->notes = $Customers->notes;
        $Langganan->regencies_id = $Customers->regencies_id;
        $Langganan->flowers_id = 1;
        $Langganan->total = 1;
        $Langganan->day_id = 1;
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
    public function edit($id)
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
            'flowers' => Flowers::orderBy('name', 'asc')->get(),
            'day' => Day::whereBetween('id', [1, 8])->orderBy('id', 'asc')->get(),
            'pesanans' => $pesanans
            // ... tambahkan data lain yang diperlukan ...
        ];
        return view('customers.langgananEdit', $data);
    }

    public function update(Request $request, Langganan $langganan, $id)
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

        return redirect('/subscribers')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Langganan $langganan, $id)
    {
        $deletedLangganan = Langganan::find($id);

        if ($deletedLangganan) {
            Langganan::destroy($id);
            session()->flash('success', 'Data Langganan berhasil dihapus !');
        } else {
            session()->flash('error', 'Data Langganan tidak ditemukan !');
        }
    }

    public function search(Request $request)
    {
        $data = Customers::where('name', 'like', '%' . $request->q . '%')->paginate(10);

        return response()->json($data);
    }

    public function getCustomerData($name)
    {
        $customer = Customers::where('name', $name)->first();
        return response()->json([
            'address' => $customer->address,
            'phone' => $customer->phone,
            'regencies_id' => $customer->regencies_id,
            'notes' => $customer->notes,
        ]);
    }
}
