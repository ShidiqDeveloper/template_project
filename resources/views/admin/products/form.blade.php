<div class="form-group">
    <x-forms.input-grid value="{{ $product->product_name ?? '' }}" col1="2" col2="6" label="Nama" name="product_name" placeholder="Masukan nama produk..."></x-forms.input-grid>
    <x-forms.input-grid type="number" value="{{ $product->product_code ?? '' }}" col1="2" col2="6" label="Kode Produk" name="product_code" placeholder="Masukan kode produk..."></x-forms.input-grid>
    <x-forms.input-grid type="hidden" value="{{ $product->product_code ?? '' }}" col1="2" col2="6" label="Kode Produk" name="product_code_old"></x-forms.input-grid>
    <x-forms.input-grid value="{{ $product->product_price_capital ?? '' }}" type="number" col1="2" col2="6" label="Harga Modal" name="product_price_capital" placeholder="Masukan harga modal..."></x-forms.input-grid>
    <x-forms.input-grid value="{{ $product->product_price_sell ?? '' }}" type="number" col1="2" col2="6" label="Harga Jual" name="product_price_sell" placeholder="Masukan harga jual..."></x-forms.input-grid>
    <x-forms.textarea-grid value="{{ $product->product_description ?? '' }}" label="Deskripsi" name="product_description"></x-forms.textarea-grid> 
</div>