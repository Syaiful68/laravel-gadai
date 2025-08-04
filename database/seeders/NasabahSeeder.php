<?php

namespace Database\Seeders;

use App\Models\Nasabah;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NasabahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'nik' => '12312313',
                'name' => Str::upper('paijo'),
                'gender' => 'L',
                'alamat' => 'Jl.patuan nagari',
                't_lahir' => '1990-02-28',
                'contact' => '82168388758',
                'jobs' => 'Wirausaha',
            ],
            [
                'nik' => '12312314',
                'name' => Str::upper('sahat'),
                'gender' => 'L',
                'alamat' => 'Jl. Pdt Leman',
                't_lahir' => '1991-05-28',
                'contact' => '82168388758',
                'jobs' => 'Wirausaha',
            ],
            [
                'nik' => '12312318',
                'name' => Str::upper('Ruslan'),
                'gender' => 'P',
                'alamat' => 'Jl.patuan nagari',
                't_lahir' => '1992-02-28',
                'contact' => '82168388758',
                'jobs' => 'IRT',
            ],
        ];

        foreach ($data as $key => $value) {
            Nasabah::create($value);
        }
    }
}
