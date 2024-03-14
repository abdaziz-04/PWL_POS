<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data User</title>
</head>

<body>
    <h1>Data User</h1>
    <table border="1" cellSpacing="0" cellPadding="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>ID Level Pengguna</th>
            <td>Aksi</td>
        </tr>
        @foreach ($data as $d)
            <tr>
                <td>{{ $d->user_id }}</td>
                <td>{{ $d->username }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->level_id }}</td>
                <td><a href="/user/ubah/{{ $d->user_id }}">Ubah</a> | <a
                        href="/user/hapus/{{ $d->user_id }}">Hapus</a>
                </td>
            </tr>
        @endforeach

        <a href="/user/tambah/" class="btn btn-primary">Tambah</a>
        {{-- Ini menampilkan jumlah pengguna dengan count --}}
        {{-- <tr>
            <th>Jumlah Pengguna</th>
        </tr>
        <tr>
            <td>{{ $data }}</td>
        </tr> --}}
    </table>
</body>

</html>
