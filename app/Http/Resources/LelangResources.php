<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LelangResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code' => $this->code_lelang,
            'pinjaman' => $this->pinjam->code_pinjam,
            'jaminan' => $this->pinjam->jaminan,
            'nasabah' => $this->nasabah->name,
            'nominal' => $this->nominal,
            'status' => $this->status
        ];
    }
}
