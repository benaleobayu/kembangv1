<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Regency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Orders;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->query('search');

        if (!empty($search)) {
            $query = Customers::where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->paginate(10)->withQueryString();
        } else {
            $query = Customers::orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        }


        return view('customers.customersIndex', [
            'data' => $query,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.customersCreate', [
            'data' => Customers::all(),
            'regency' => Regency::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $createUser = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'regencies_id' => 'required',
            'phone' => 'required|min:3|numeric',
            'notes' => 'max:255'
        ]);

        Customers::create($createUser);
        return redirect('/customers')->with('success', 'Data berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customers $customers, $id)
    {
        $data = $customers->find($id);
        return view('customers.customersShow', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customers $customers, $id)
    {
        $data = $customers->find($id);
        return view('customers.customersEdit', [
            'data' => $data,
            'regency' => Regency::orderBy('name', 'asc')->get()
        ]);
    }

    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'regencies_id' => 'required',
            'phone' => 'required',
            'interest' => 'max:255'
        ];
        $validateData = $request->validate($rules);

        Customers::where('id', $id)
            ->update($validateData);
        return redirect('/customers')->with('success', 'User Berhasil diubah !');
    }

    public function destroy(string $id)
    {
        $delete = Customers::find($id);
        if($delete){
            Customers::destroy($id);
            session()->flash('success', 'User Berhasil dihapus !');
        }else{
            session()->flash('error', 'User gagal dihapus !');
        }
    }
}
