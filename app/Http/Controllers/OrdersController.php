<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Models\Flowers;
use App\Models\Orders;
use App\Models\Regency;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if(!empty($search))
        {
            $query = Orders::where('name', 'like', '%' . $search . '%')
                           ->orWhere('address', 'like' , '%' . $search . '%')
                           ->orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        }else{
            $query = Orders::orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        }


        return view('orders.ordersIndex',[
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
    public function store(StoreOrdersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $orders, $id)
    {
        $collect = $orders->find($id);

        return view('orders.ordersShow',[
            'data' => $collect,
            'regency' => Regency::orderBy('name', 'asc')->get(),
            'flowers' => Flowers::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders, $id)
    {

        $collect = $orders->find($id);

        return view('orders.ordersEdit',[
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

        if($request->file('image'))
        {
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
        Orders::destroy($id);

        return redirect('/orders')->with('success', 'Order berhasil dihapus !');

    }
}
