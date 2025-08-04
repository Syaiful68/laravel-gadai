<table>
    <thead>
        <tr>
            <th>Nik</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>Contact</th>
            <th>Pekerjaan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $item->nik }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->gender }}</td>
            <td>{{ $item->alamat }}</td>
            <td>{{ $item->t_lahir }}</td>
            <td>+62{{ $item->contact }}</td>
            <td>{{ $item->jobs}}</td>
            <td>{{ $item->status}}</td>
        </tr>
        @endforeach
    </tbody>
</table>