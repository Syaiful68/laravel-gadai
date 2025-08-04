<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Nasabah;
use Inertia\Inertia;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //

    public function index(Request $request)
    {
        if ($request->year === null) {
            $monthlyData = Angsuran::select(
                DB::raw("DATE_FORMAT(do_date,'%Y-%m') as month"),
                DB::raw("SUM(nominal) as total_comisi")
            )->whereYear('do_date', date('Y'))->groupBy('month')->orderBy('month')->get();
        } else {
            $monthlyData = Angsuran::select(
                DB::raw("DATE_FORMAT(do_date,'%m') as month"),
                DB::raw("SUM(nominal) as total_comisi")
            )->whereYear('do_date', $request->year)->groupBy('month')->orderBy('month')->get();
        }


        $cost_out = Pinjaman::select(DB::raw("IFNULL(SUM(pinjaman),0) as total"))->where('status', 'incomplete')->get();
        $cost_in = Pinjaman::select(DB::raw("IFNULL(SUM(comisi),0) as total"))->where('status', 'complete')->get();
        $nasabah = Nasabah::query()->where('status', 'active')->count();
        $incomplete = Pinjaman::query()->where('status', 'incomplete')->count();

        return Inertia::render('DashboardView', [
            'data' => $monthlyData->toArray(),
            'cost_out' => $cost_out[0]['total'],
            'cost_in' => $cost_in[0]['total'],
            'nasabah' => $nasabah,
            'incomplete' => $incomplete
        ]);
    }
}
