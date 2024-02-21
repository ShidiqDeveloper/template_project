@extends('layouts.admin.app')

@section('content')

  <div class="card">
    <div class="card-body">

      <form action="{{ route('app.transactions.store') }}" method="POST" with-submit-crud>
        @csrf
        @include('admin.transactions.form')
        <button class="btn btn-success btn-sm mt-3">Lakukan Transaksi</button>
      </form>

    </div>
  </div>

@endsection
@push('script')
    <script>
        function getDataProduct(event) {
            fetch('/app/transactions/detail_trans?product_code=' + event.target.value)
                .then(response => response.json())
                .then(response => {
                    document.querySelector('input[name="nama_barang"]').value = response.product.product_name || ''
                    document.querySelector('input[name="product_price"]').value = response.product.product_price_sell || ''
                })
        }

        function getTotalPrice(event) {
            let harga_produk = document.querySelector('input[name="product_price"]').value
            if (harga_produk) {
                document.querySelector('input[name="total_harga"]').value = harga_produk * event.target.value
            }
        }

        function changeMoney(event) {
            const totalHarga = document.querySelector('input[name="total_harga"]').value
            let change = 0
            if (totalHarga && parseInt(event.target.value) > parseInt(totalHarga)) {
              change = parseInt(event.target.value) - parseInt(totalHarga)
            }

            document.querySelector('input[name="kembalian"]').value = change
        }


    </script>
@endpush