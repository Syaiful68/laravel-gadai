<table>
    <thead>
        <tr>
            <th>Nik</th>
            <th>Nama</th>
            <th>User</th>
            <th>Role User</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $item->nik }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->user }}</td>
            <td>{{ $item->roles }}</td>
            <td>{{ $item->is_active }}</td>
        </tr>
        @endforeach
    </tbody>
</table>