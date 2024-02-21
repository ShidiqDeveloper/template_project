@extends('layouts.admin.app')

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th>Nama Barang</th>
                            <td>: {{ $transaction->nama_barang }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Barang</th>
                            <td>: {{ $transaction->jlh_barang }}</td>
                        </tr>
                        <tr>
                            <th>Kode Barang</th>
                            <td>: {{ $transaction->product_code }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th>Total Harga</th>
                            <td>: {{ 'Rp ' . number_format($transaction->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Kembalian</th>
                            <td>: {{ 'Rp ' . number_format($transaction->kembalian, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>: {{ $transaction->created_at->format('d F Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
