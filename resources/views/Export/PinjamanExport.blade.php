<table>
    <thead>
        <tr>
            <th>Code Pinjaman</th>
            <th>Nasabah</th>
            <th>Jaminan</th>
            <th>Pinjaman</th>
            <th>Term</th>
            <th>Comisi</th>
            <th>Total Bayar</th>
            <th>Tanggal</th>
            <th>Tanggal Bayar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $item->code_pinjam }}</td>
            <td>{{ $item->nasabah->name }}</td>
            <td>{{ $item->jaminan }}</td>
            <td>Rp. {{ number_format($item->pinjaman) }}</td>
            <td>{{ $item->term }}</td>
            <td>{{ $item->persentages }} %</td>
            <td>Rp. {{ number_format($item->total) }}</td>
            <td>{{ date("d-m-Y",strtotime($item->do_date)) }}</td>
            <td>{{ date("d-m-Y",strtotime($item->term_date)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>