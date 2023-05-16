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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            // 'permissions' => 'required|array',
            
        ]);

        $validatedData['guard_name'] = 'web';
        $data = Roles::create($validatedData);

        // $data->syncPermissions($validatedData['permissions']);


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
    public function update(Request $request, $id)
    {
        $data = Roles::find($id);
        $validatedData = $request->validate([
            'name' => 'required',
            // 'permissions' => 'required|array'
        ]);

        $validatedData['guard_name'] = 'web';
        $assign = Roles::where('id', $id)->update($validatedData);
        // $assign->syncPermissions($validatedData['permissions']);

        $permissions = $request->input('permissions', []);
        $data->syncPermissions($permissions);


        return redirect('/roles')->with('success', 'Roles berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Roles $roles, $id)
    {
        $deletedLangganan = Roles::find($id);

        if ($deletedLangganan) {
            Roles::destroy($id);
            session()->flash('success', 'Data Langganan berhasil dihapus !');
        } else {
            session()->flash('error', 'Data Langganan tidak ditemukan !');
        }
    }
}
