<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if(!empty($search)){
            $query = Roles::where('name', 'like', '%' . $search . '%')->paginate(10)->withQueryString();
        }else{
            $query = Roles::orderBy('id', 'asc')->paginate(10)->withQueryString();
        }

        return view('settings.adminRolesIndex',[
            'spell' => $query,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Roles $roles)
    {
        $finding = $roles->find($roles->id);
        return view ('settings.adminRolesCreate',[
            'spell' => $finding,
            'readCustomers' => 'Read_Customers',
            'createCustomers' => 'Create_Customers',
            'editCustomers' => 'Edit_Customers',
            'deleteCustomers' => 'Delete_Customers',
            'readLangganan' => 'Read_Langganan',
            'createLangganan' => 'Create_Langganan',
            'editLangganan' => 'Edit_Langganan',
            'deleteLangganan' => 'Delete_Langganan',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $role = $roles->findOrFail($roles->id);
        $validatedData = $request->validate([
            'name' => 'required',
            'permissions' => 'required|array',
        ]);

        $validatedData['guard_name'] = 'web';
        $role = Roles::create($validatedData);
        $role->syncPermissions($validatedData['permissions']);


        return redirect('/roles')->with('success', 'Roles berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Roles $roles, $id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Roles $roles, $id)
    {   
        $finding = $roles->find($id);
        return view ('settings.adminRolesEdit',[
            'spell' => $finding,
            'read' => 'Read_',
            'create' => 'Create_',
            'edit' => 'Edit_',
            'delete' => 'Delete_',
            'Customers' => 'Customers',
            'Langganan' => 'Langganan',
            'DataRiders' => 'DataRiders',
            'DataOrders' => 'DataOrders',
            'PaymentRiders' => 'PaymentRiders',
            'Invoices' => 'Invoice',
            'Dokumentasi' => 'Dokumentasi',
            'Admin' => 'Admin',
            'Roles' => 'Roles',
            'Regency' => 'Regency',
            'Flower' => 'Flower'

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Roles $role)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'permissions' => 'required|array',
            'access' => 'array'
        ]);

        $validatedData['guard_name'] = 'web';
        $role->syncPermissions($validatedData['permissions']);

        return redirect('/roles')->with('success', 'Roles berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Roles $roles, $id)
    {
        Roles::destroy($id);

        return redirect('/roles')->with('success', 'Roles berhasil dihapus');
    }
}