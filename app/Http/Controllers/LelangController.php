<?php

namespace App\Http\Controllers;

use App\Models\Lelang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LelangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        if ($request->q) {
            $data = Lelang::query()->with('pinjam')->whereAny([
                'code_lelang'
            ], 'like', '%' . $request->q . '%');
        } else {
            $data = Lelang::query()->with('pinjam');
        }
        // $data = Lelang::query()->with('pinjam')->paginate();
        return Inertia::render('Lelang/index', [
            'data' => $data->paginate(10)
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
    public function show(string $lelang)
    {
        //
        $data = Lelang::query()->with('pinjam')->where('code_lelang', $lelang)->first();
        return Inertia::render('Lelang/detail', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $lelang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $lelang)
    {
        //
        $query = Lelang::query()->where('code_lelang', $lelang)->first();
        $query->update([
            'status' => $request->status,
            'nominal' => $request->nominal,
            'updated_at' => Carbon::now()
        ]);

        return to_route('lelang.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lelang $lelang)
    {
        //
    }
}
