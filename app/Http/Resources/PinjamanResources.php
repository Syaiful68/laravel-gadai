<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PinjamanResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code_pinjam' => $this->code_pinjam,
            'nasabah' => $this->nasabah->name,
            'contact' => $this->nasabah->contact,
            'pinjaman' => $this->pinjaman,
            'term' => $this->term_date,
            'persentages' => $this->persentages,
            'status' => $this->status
        ];
    }
}
