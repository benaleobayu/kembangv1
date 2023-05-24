<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Models\Day;
use App\Models\Flowers;
use App\Models\Langganan;
use App\Models\Orders;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->query('search');

    if (!empty($search)) {
        $query = Day::where('name', 'like', '%' . $search . '%')
            ->whereBetween('id', [2, 8])
            ->orderBy('id', 'asc')->paginate(10)->withQueryString();
    } else {
        $query = Day::whereBetween('id', [2, 8])
            ->orderBy('id', 'asc')->paginate(10)->withQueryString();
    }

    return view('orders.ordersIndex', [
        'data' => $query,
        'search' => $search,
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(Orders $orders)
    {
        $day = $orders->day;
        $slug = strtolower(str_replace(' ', '-', $day));
        $collect = Orders::all();

        $pesanans = $collect->pesanans ?? [];


        return view('orders.ordersOnCreate', [
            'data' => $collect,
            'regency' => Regency::orderBy('name', 'asc')->get(),
            'flowers' => Flowers::all(),
            'day' => Day::whereBetween('id', [1, 8])->orderBy('id', 'asc')->get(),
            'pesanans' => $pesanans,
            'slug' => $slug
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrdersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Day $day, $slug)
    {
        $query = $day->where('slug', $slug)->firstOrFail()->orders()->orderBy('updated_at','desc');

        $search = $request->query('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }
        $id = $day->id;

        $dates = $query->paginate(25)->withQueryString();

        return view('orders.ordersOnShow', [
            'data' => $dates,
            'search' => $search,
            'slug' => $slug,
            'id' => $id,
            'days' => Day::orderBy('id', 'asc')->get(),

        ]);
    }

    public function edit(Orders $orders, $id)
    {
        $day = $orders->day;
        $slug = strtolower(str_replace(' ', '-', $day));
        $collect = $orders->find($id);

        $pesanans = $collect->pesanans ?? [];


        return view('orders.ordersOnEdit', [
            'data' => $collect,
            'regency' => Regency::orderBy('name', 'asc')->get(),
            'flowers' => Flowers::all(),
            'day' => Day::whereBetween('id', [1, 8])->orderBy('id', 'asc')->get(),
            'pesanans' => $pesanans,
            'slug' => $slug
        ]);
    }

    public function update(Request $request, Orders $orders, $id)
    {
        $customer = $orders->find($id);
        $slug = Day::findOrFail($customer->day_id)->slug;

        $request->validate([
            'name' => 'required',
            'address' => 'required|max:255',
            'regencies_id' => 'required',
            'phone' => 'string',
            'date' => 'date',
            'day_id' => 'required',
            'notes' => 'max:255',
            'image' => 'image|mimes:jpeg,jpg,png,bmp,gif,svg|file|max:10240',
            'pesanans' => 'nullable|array',
            'pesanans.*.flowers_id' => 'required|exists:flowers,id',
            'pesanans.*.total' => 'required|integer',
        ]);
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $customer->image = $request->file('image')->store('doc-img');
        }

        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->regencies_id = $request->regencies_id;
        $customer->phone = $request->phone;
        $customer->date = $customer->day->date;
        $customer->day_id = $request->day_id;
        $customer->notes = $request->notes;
        $customer->pic = auth()->user()->name;

        $customer->pesanans()->delete();

        if ($request->has('pesanans')) {
            foreach ($request->pesanans as $pesanan) {
                $customer->pesanans()->create([
                    'flowers_id' => $pesanan['flowers_id'],
                    'total' => $pesanan['total'],
                ]);
            }
        }

        $customer->save();

        return redirect('/orders/' . $slug)->with('success', 'Order berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders, $id)
    {
        $deleted = Orders::find($id);

        if ($deleted) {
            Orders::destroy($id);
            session()->flash('success', 'Data order berhasil dihapus !');
        } else {
            session()->flash('error', 'Data order tidak ditemukan !');
        }
    }

    public function importData(Request $request)
    {
        $dayId = $request->input('day_id');

        $langganans = Langganan::where('day_id', $dayId)->get();


        foreach ($langganans as $langganan) {
            // Ambil nilai yang diperlukan dari tabel langganans
            $name = $langganan->name;
            $address = $langganan->address;
            $phone = $langganan->phone;
            $regencies_id = $langganan->regencies_id;
            $notes = $langganan->notes;
            $pic = $langganan->pic;

            // Buat baris baru dalam tabel orders
            $order = new Orders;
            $order->name = $name;
            $order->address = $address;
            $order->regencies_id = $regencies_id;
            $order->phone = $phone;
            $order->flowers_id = 1;
            $order->day_id = $dayId; // Set nilai day_id untuk baris order
            $order->notes =  $notes;
            $order->pic =  $pic;
            $order->save();
        }

        // Berhasil mengimpor data
        if ($langganans){
            $order->save();
            session()->flash('success', 'Data Langganan berhasil diimport !');
        }else {
            session()->flash('error', 'Data Langganan gagal diimport !');
        }
    }
}
