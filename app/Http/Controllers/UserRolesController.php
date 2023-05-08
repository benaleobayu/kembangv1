<?php

namespace App\Http\Controllers;

use App\Models\UserRoles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRolesRequest;
use App\Http\Requests\UpdateUserRolesRequest;

class UserRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if (!empty($search)) {
            $query = UserRoles::where('name', 'like', '%' . $search . '%')
                        ->orderBy('id', 'asc')->paginate(10)->withQueryString();
        } else {
            $query = UserRoles::orderBy('id', 'asc')->paginate(10)->withQueryString();
        }
        return view('settings.adminRolesIndex', [
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
    public function store(StoreUserRolesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserRoles $userRoles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserRoles $userRoles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRolesRequest $request, UserRoles $userRoles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserRoles $userRoles)
    {
        //
    }
}
