<?php

namespace App\Http\Controllers;

use App\Http\Resources\PinjamanResources;
use App\Models\Angsuran;
use App\Models\Lelang;
use App\Models\Nasabah;
use App\Models\Notifikasi;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Pinjaman::with(['nasabah'])->get();
        return Inertia::render('Pinjaman/index', [
            'data' => PinjamanResources::collection($data),
            'total_entries' => Pinjaman::count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $nasabah = Nasabah::query()->whereNot('status', 'blacklist')->get(['id', 'name']);
        return Inertia::render('Pinjaman/create', [
            'data' => $nasabah
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nasabah' => 'required',
            'pinjaman' => 'required',
            'term' => 'required',
            'date' => 'required',
            'comisi' => 'required',
            'persentage' => 'required',
            'jaminan' => 'required'
        ]);

        // $nasabah = Pinjaman::query()->where('nasabah_id', $request->nasabah)->where('status', 'incomplete')->latest()->first();

        // if ($nasabah !== null) {
        //     return back()->with('failed', 'masih ada pinjaman');
        // }

        $query = Pinjaman::query()->latest()->first();
        if ($query === null) {
            $n = 1;
        } else {
            $n = $query->id + 1;
        }
        $h = 'PGH';
        $code = $h . str_pad($n, 6, 0, STR_PAD_LEFT);
        $total = $request->comisi + $request->pinjaman;
        $date = Carbon::parse($request->date);
        $term = intval($request->term);
        $end_date = $date->addMonth($term);
        Pinjaman::create([
            'code_pinjam' => $code,
            'nasabah_id' => $request->nasabah,
            'pinjaman' => $request->pinjaman,
            'term' => $request->term,
            'term_date' => $end_date,
            'do_date' => $request->date,
            'comisi' => $request->comisi,
            'persentages' => $request->persentage,
            'jaminan' => $request->jaminan,
            'total' => $total,
            'user_id' => Auth::id()
        ]);
        Notifikasi::create([
            'name' => $code,
            'deadline' => $end_date,
            'description' => 'belum bayar',
            'status' => 'show'
        ]);
        return to_route('pinjaman.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $pinjaman)
    {
        //
        $query = Pinjaman::query()->where('code_pinjam', $pinjaman)->first();
        $angsuran = Angsuran::query()->with('pinjaman')->where('pinjaman_id', $query->id)->latest()->get();
        $nasabah = Nasabah::get(['id', 'name']);
        return Inertia::render('Pinjaman/detail', [
            'data' => $query,
            'nasabah' => $nasabah,
            'angsuran' => $angsuran
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $pinjaman)
    {
        //
        $query = Pinjaman::query()->where('code_pinjam', $pinjaman)->first();

        if ($request->status === 'lelang') {
            $query->update([
                'status' => $request->status
            ]);
            $lelang = Lelang::query()->latest()->first();
            if ($lelang !== null) {
                $last_code = $lelang->id + 1;
            } else {
                $last_code = 1;
            }
            $h = "LMA";
            $code = $h . str_pad($last_code, 6, 0, STR_PAD_LEFT);
            Lelang::create([
                'code_lelang' => $code,
                'pinjam_id' => $query->id,
                'nasabah_id' => $query->nasabah_id,
                'user_id' => Auth::id()
            ]);

            $query = Notifikasi::query()->where('name', $pinjaman)->latest()->first();
            $query->update([
                'status' => 'hide'
            ]);
            return to_route('pinjaman.index');
            // 
        } else {
            $query->update([
                'term_date' => $request->last_date,
                'status' => $request->status,
                'user_id' => Auth::id()
            ]);
            return to_route('pinjaman.index');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $pinjaman)
    {
        //
        $query = Pinjaman::query()->where('code_pinjam', $pinjaman)->first();
        if ($query === null) {
            return 'Data not found';
        } else {
            $query->delete();
        }
    }
}
