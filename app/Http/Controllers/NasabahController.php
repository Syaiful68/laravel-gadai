<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Nasabah;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->q) {
            $data = Nasabah::query()->whereAny([
                'name'
            ], 'like', '%' . $request->q . '%');
        } else {
            $data = Nasabah::query();
        }
        // $data = Nasabah::query()->paginate(10);
        return Inertia::render('Nasabah/index', [
            'data' => $data->latest()->simplePaginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('Nasabah/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nik' => 'required|unique:tb_nasabah,nik|numeric',
            'nama' => 'required',
            't_lahir' => 'required',
            'contact' => 'required|numeric',
            'job' => 'required',
            'alamat' => 'required',
            'gender' => 'required'
        ]);

        Nasabah::create([
            'nik' => $request->nik,
            'name' => Str::upper($request->nama),
            't_lahir' => date('Y-m-d H:i:s', strtotime($request->t_lahir)),
            'contact' => $request->contact,
            'alamat' => $request->alamat,
            'jobs' => $request->job,
            'gender' => $request->gender,
            'user_id' => Auth::id()
        ]);
        return to_route('nasabah.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nasabah $nasabah)
    {
        //
        return Inertia::render('Nasabah/detail', [
            'data' => $nasabah
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nasabah $nasabah)
    {
        //
        $nasabah->update([
            'status' => $request->status,
            'contact' => $request->contact,
            'updated_at' => Carbon::now()
        ]);

        return to_route('nasabah.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nasabah $nasabah)
    {
        //
        $nasabah->delete();
        return to_route('nasabah.index');
    }
}
