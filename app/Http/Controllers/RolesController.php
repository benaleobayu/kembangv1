<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

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
            $query = Roles::orderBy('name', 'asc')->paginate(10)->withQueryString();
        }

        return view('settings.adminRolesIndex',[
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
        //
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
        $role = Role::findOrFail($id);
        $finding = $roles->find($id);
        return view ('settings.adminRolesEdit',[
            'data' => $finding,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Roles $roles, $id)
    {
        $role = $roles->findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $validatedData['guard_name'] = 'web';
        $permissions = $request->input('permissions', []);
        $role->syncPermissions($permissions);

        Roles::where('id', $id)->update($validatedData);

        return redirect('/roles')->with('success', 'Roles berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Roles $roles)
    {
        //
    }
}
