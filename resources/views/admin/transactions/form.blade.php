<div class="form-group">
    <x-forms.input-grid onchange="getDataProduct(event)" type="number" col1="2" col2="6" label="Kode Produk" name="product_code" placeholder="Masukan kode produk..."></x-forms.input-grid>
    <x-forms.input-grid readonly col1="2" col2="6" label="Nama Produk" name="nama_barang" placeholder="Nama produk..."></x-forms.input-grid>
    <x-forms.input-grid readonly type="number" col1="2" col2="6" label="Harga Produk" name="product_price" placeholder="Harga produk..."></x-forms.input-grid>
    <x-forms.input-grid onchange="getTotalPrice(event)" type="number" col1="2" col2="6" label="Jumlah Produk" name="jlh_barang" placeholder="Jumlah produk..."></x-forms.input-grid>
    <x-forms.input-grid readonly type="number" col1="2" col2="6" label="Total Harga" name="total_harga" placeholder="Total harga..."></x-forms.input-grid>
    <x-forms.input-grid onchange="changeMoney(event)" readonly type="number" col1="2" col2="6" label="Jumlah Uang" name="total_uang" placeholder="Jumlah Uang..."></x-forms.input-grid>
    <x-forms.input-grid readonly type="number" col1="2" col2="6" label="Kembalian" name="kembalian" placeholder="Kembalian..."></x-forms.input-grid>
</div>