<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Lelang;
use App\Models\Nasabah;
use App\Models\Pinjaman;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use App\Exports\LelangExport;
use App\Exports\NasabahExport;
use App\Exports\PinjamanExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    //
    public function index(Request $request)
    {
        return Inertia::render('ReportView', [
            'data' => 'Data'
        ]);
    }

    public function export(Request $request)
    {

        $date = Carbon::now()->isoFormat('D-M-Y');
        $type = $request->type;
        if ($type === 'nasabah') {
            $data = Nasabah::all();
            return Excel::download(new NasabahExport($data), 'nasabah ' . $date . '.xlsx');
        }
        if ($type === 'lelang') {
            $data = Lelang::query()->whereBetween('created_at', [$request->from, $request->to])->get();
            return Excel::download(new LelangExport($data), 'lelang ' . $date . '.xlsx');
        }
        if ($type === 'pinjaman') {
            $data = Pinjaman::query()->with('nasabah')->whereBetween('do_date', [$request->from, $request->to])->Get();
            return Excel::download(new PinjamanExport($data), 'pinjaman ' . $date . '.xlsx');
        }
        if ($type === 'user') {
            $data = User::query()->whereBetween('created_at', [$request->from, $request->to])->Get();
            return Excel::download(new UserExport($data), 'users ' . $date . '.xlsx');
        }
        return back()->with(['msg' => 'Data not found']);
    }
}
