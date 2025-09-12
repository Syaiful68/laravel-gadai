<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Notifikasi;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AngsuranController extends Controller
{
    //

    public function store(Request $request)
    {
        $request->validate([
            'code_pinjam' => 'required',
            'nominal' => 'required|numeric|min:1'
        ]);

        $pinjam = Pinjaman::query()->where('code_pinjam', $request->code_pinjam)->first();
        $hitung = Angsuran::query()->where('pinjaman_id', $pinjam->id)->latest()->first();
        if ($hitung !== null) {
            $sisa = $hitung->sisa_bayar - intval($request->nominal);
            if ($sisa < 0) {
                return back()->with('message', 'Angka terlalu besar');
            }
            if ($sisa !== 0) {
                Angsuran::create([
                    'pinjaman_id' => $pinjam->id,
                    'nominal' => $request->nominal,
                    'do_date' => $request->date,
                    'sisa_bayar' => $sisa,
                    'payment_type' => $request->payment_type,
                    'user_id' => Auth::id()
                ]);
            } else {
                Angsuran::create([
                    'pinjaman_id' => $pinjam->id,
                    'nominal' => $request->nominal,
                    'do_date' => $request->date,
                    'sisa_bayar' => $sisa,
                    'payment_type' => $request->payment_type,
                    'user_id' => Auth::id()
                ]);
                Pinjaman::query()->where('id', $pinjam->id)->update([
                    'status' => 'complete'
                ]);

                $query = Notifikasi::query()->where('name', $request->code_pinjam)->first();
                $query->update([
                    'status' => 'hide'
                ]);
                return redirect()->to('/pinjaman');
            }
        } else {
            $sisa = $pinjam->total - intval($request->nominal);
            if ($sisa < 0) {
                return back()->with('message', 'Angka terlalu besar');
            }
            if ($sisa !== 0) {
                Angsuran::create([
                    'pinjaman_id' => $pinjam->id,
                    'nominal' => $request->nominal,
                    'do_date' => $request->date,
                    'sisa_bayar' => $sisa,
                    'payment_type' => $request->payment_type,
                    'user_id' => Auth::id()
                ]);
            } else {
                Angsuran::create([
                    'pinjaman_id' => $pinjam->id,
                    'nominal' => $request->nominal,
                    'do_date' => $request->date,
                    'sisa_bayar' => $sisa,
                    'payment_type' => $request->payment_type,
                    'user_id' => Auth::id()
                ]);
                Pinjaman::query()->where('id', $pinjam->id)->update([
                    'status' => 'complete'
                ]);
                $query = Notifikasi::query()->where('name', $request->code_pinjam)->first();
                $query->update([
                    'status' => 'hide'
                ]);
                return redirect()->to('/pinjaman');
            }
        }
    }
}
