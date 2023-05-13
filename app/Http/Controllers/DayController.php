<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDayRequest;
use App\Http\Requests\UpdateDayRequest;
use App\Models\Day;
use App\Models\Langganan;
use Illuminate\Http\Request;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if(!empty($search)){
            $query = Day::where('name', 'like', '%' . $search . '%')
                    ->orderBy('id', 'asc')->paginate(10)->withQueryString();
        }else{
            $query = Day::orderBy('id', 'asc')->paginate(10)->withQueryString();
        }

        return view('customers.dayIndex',[
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
    public function store(StoreDayRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Day $day, $slug)
    {
        $query = $day->where('slug', $slug)->firstOrFail()->langganan();

        $search = $request->query('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        $dates = $query->paginate(10)->withQueryString();

        return view('customers.dayOnIndex',[
            'data' => $dates,
            'search' => $search,
            'slug' => $slug
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Day $day, $id)
    {
        $data = $day->find($id);
        return view('customers.dayEdit',[
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'slug' => 'nullable',
            'date' => 'nullable'
        ]);

        Day::where('id', $id)->update($validateData);

        return redirect('/daysubscribs')->with('success', 'Nama hari langganan berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Day $day)
    {
        //
    }

   
}
