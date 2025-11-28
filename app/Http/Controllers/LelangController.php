<?php

namespace App\Http\Controllers;

use App\Http\Resources\LelangResources;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Lelang;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use function Symfony\Component\Clock\now;

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
            'data' => LelangResources::collection($data->get()),
            'total_entries' => Lelang::count()
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
        // if ($request->status === 'complete') {
        //     return back()->with('msg', 'status sudah success');
        // }
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
    public function destroy(string $lelang)
    {
        //
        $query = Lelang::query()->where('code_lelang', $lelang)->first();
        // ubah dari lelang jadi angsur di pinjaman table
        Pinjaman::query()->where('id', $query->pinjam_id)->update([
            'status' => 'incomplete',
            'updated_at' => Carbon::now(),
            'user_id' => Auth::id()
        ]);
        $query->delete();
    }
}
