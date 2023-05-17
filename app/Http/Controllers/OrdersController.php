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
                ->orderBy('id', 'asc')->paginate(10)->withQueryString();
        } else {
            $query = Day::orderBy('id', 'asc')->paginate(10)->withQueryString();
        }

        return view('orders.ordersIndex', [
            'data' => $query,
            'search' => $search,
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
    public function store(StoreOrdersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Day $day, $slug)
    {
        $query = $day->where('slug', $slug)->firstOrFail()->orders();

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders, $id)
    {

        $collect = $orders->find($id);

        return view('orders.ordersOnEdit', [
            'data' => $collect,
            'regency' => Regency::orderBy('name', 'asc')->get(),
            'flowers' => Flowers::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders, $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'address' => 'required|max:255',
            'regencies_id' => 'required',
            'phone' => 'numeric',
            'flowers_id' => 'numeric',
            'total' => 'numeric',
            'notes' => 'max:255',
            'date' => 'date',
            'image' => 'image|mimes:jpeg,jpg,png,bmp,gif,svg|file|max:10240'
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('doc-img');
        }

        $validateData['pic'] = auth()->user()->name;

        Orders::where('id', $id)->update($validateData);

        return redirect('/orders')->with('success', 'Order berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders, $id)
    {
        $deleted = Orders::find($id);

        if ($deleted) {
            Orders::destroy($id);
            session()->flash('success', 'Data Langganan berhasil dihapus !');
        } else {
            session()->flash('error', 'Data Langganan tidak ditemukan !');
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
        return 'Data berhasil diimpor ke tabel orders.';
    }
}
