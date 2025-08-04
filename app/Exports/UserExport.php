<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class UserExport implements FromView
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
    public function View(): View
    {
        //
        return view('Export.UserExport', [
            'data' => $this->data
        ]);
    }
}
