<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (!empty($search)) {
            $query = User::where('name', 'like', '%' . $search . '%')->orWhere('username', 'like', '%' . $search . '%')->orWHere('email', 'like', '%' . $search . '%')->orderBy('id', 'asc')->paginate(10)->withQueryString();
        } else {
            $query = User::orderBy('id', 'asc')->paginate(10)->withQueryString();
        }
        // $collectionRoles = collect($query->roles);
        return view('settings.adminIndex', [
            'data' => $query,
            'search' => $search,
            // 'roles' => $collectionRoles[0]["name"]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.adminCreate', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'username' => 'required|min:3|max:16',
            'email' => 'required|email',
            'password' => 'required',
            'roles_id' => 'required'
        ]);

        $validateData['password'] = Hash::make($request->input('password'));
        $validateData['remember_token'] = Str::random(16);

        User::create($validateData);

        return redirect('/admin')->with('success', 'Admin berhasil dibuat !');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, $id)
    {
        $data = $user->find($id);
        return view('settings.adminShow', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, $id)
    {
        $data = $user->find($id);
        return view('settings.adminEdit', [
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, $id)
    {
        $data = $user->find($id);

        $validateData = $request->validate([
            'name' => 'required',
            'username' => [
                            'required',
                            'min:3',
                            'max:16',
                            Rule::unique('users')->ignore($data->id)
            ],
            'email' => 'required|email',
            'password' => 'max:16',
            'roles_id' => 'required'
        ]);
        if ($data->password) {
            $validateData['password'] = Hash::make($request->input('password'));
        }else{
            unset($data['password']);
        }

        $validateData['remember_token'] = Str::random(16);

        User::where('id', $id)->update($validateData);

        return redirect('/admin')->with('success', 'data berhasil diupdate !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, $id)
    {
        $data = $user->find($id);
        User::destroy($data->id);
        return redirect('/admin')->with('success', 'data berhasil dhapus !');

    }
}
