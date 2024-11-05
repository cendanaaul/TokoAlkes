<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $item->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .details,
        .items {
            width: 100%;
            margin-bottom: 20px;
        }

        .items th,
        .items td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .total {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Invoice Pembelian</h2>
    </div>
    <div class="details">
        <p>Nama Toko : Toko Alat Kesehatan</p>
        <p>ID: {{ $item->transaksi->code }}</p>
        <p>Nama Pembeli: {{ $item->user->name }}</p>
        <p>Tanggal Pembelian: {{ $item->created_at->format('d M Y') }}</p>
    </div>
    <table class="items">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>{{ $item->product->title }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->totalprice, 0, ',', '.') }}</td>
            </tr>

        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="total">Total</td>
                <td class="total">Rp {{ number_format($item->totalprice, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
