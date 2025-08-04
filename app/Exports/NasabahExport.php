<?php

namespace App\Exports;

use App\Models\Nasabah;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class NasabahExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {
        //
        return view('Export.NasabahExport', [
            'data' => $this->data
        ]);
    }
}
