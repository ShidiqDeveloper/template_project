@extends('layouts.admin.app')

@section('content')

  <div class="card">
    <div class="card-body table-responsive">

      @if (check_authorized("003U"))
      <a href="{{ route('app.transactions.create') }}" class="btn btn-success btn-sm mb-3">Tambah</a>
      @endif

      @if (check_authorized("003U"))
        <table class="table table-bordered" id="tableTransaksi">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Nama Barang</th>
              <th>Jumlah Barang</th>
              <th>Total Harga</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      @endif

    </div>
  </div>

@endsection

@if (check_authorized("003U"))
  @push('script')
    <script>
      CORE.dataTableServer("tableTransaksi", "/app/transactions/get");
    </script>
  @endpush
@endif
