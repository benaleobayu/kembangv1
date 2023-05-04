<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Regency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if (!empty($search)) {
            $query = User::where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->paginate(10)->withQueryString();
        } else {
            $query = User::orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        }


        $query = User::orderBy('updated_at', 'desc')->paginate(10)->withQueryString();

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
            'data' => User::all(),
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
            'interest' => 'max:255'
        ]);

        $createUser['password'] = bcrypt('password');
        $createUser['email'] = fake()->unique()->safeEmail();

        User::create($createUser);
        return redirect('/customers')->with('success', 'Data berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $users, $id)
    {
        $data = $users->find($id);
        return view('customers.customersShow', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $users, $id)
    {
        $data = $users->find($id);
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

        User::where('id', $id)
            ->update($validateData);
        return redirect('/customers')->with('success', 'User Berhasil diubah !');
    }

    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect('/customers')->with('success', 'User Berhasil dihapus !');
    }
}
