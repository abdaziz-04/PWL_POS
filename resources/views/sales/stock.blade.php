<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Barang</title>
</head>

<body>
    <h1>Daftar Stok Barang</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $stock)
                <tr>
                    <td>{{ $stock['id'] }}</td>
                    <td>{{ $stock['name'] }}</td>
                    <td>{{ $stock['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
