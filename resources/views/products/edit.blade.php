@extends('layouts.main')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <h3>Edit Produk</h3>
</div>

<div class="card">
  <div class="card-body">
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="product" class="form-label">Nama Produk</label>
          <input type="text" class="form-control @error('product') is-invalid @enderror" id="product" name="product" value="{{ old('product', $product->name) }}">
          @error('product')
          <div class="invalid-feedback text-danger">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="col-md-6">
          <label for="stock" class="form-label">Stok</label>
          <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" min="0" value="{{ old('stock', $product->stock) }}">
          @error('stock')
          <div class="invalid-feedback text-danger">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="normal-price" class="form-label">Harga Normal</label>
          <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text" class="form-control @error('normal_price') is-invalid @enderror" id="normal-price" name="normal_price" value="{{ old('normal_price', $product->normal_price) }}">
            @error('normal_price')
            <div class="invalid-feedback text-danger">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-md-6">
          <label for="member-price" class="form-label">Harga Member</label>
          <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text" class="form-control @error('member_price') is-invalid @enderror" id="member-price" name="member_price" value="{{ old('member_price', $product->member_price) }}">
            @error('member_price')
            <div class="invalid-feedback text-danger">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
        @error('description')
        <div class="invalid-feedback text-danger">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Gambar</label>
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*">
        @error('image')
        <div class="invalid-feedback text-danger">
          {{ $message }}
        </div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function () {
    $('#normal-price').val(formatRupiah($('#normal-price').val()));
    $('#normal-price').on('keyup', function () {
      this.value = formatRupiah(this.value);
    });

    $('#member-price').val(formatRupiah($('#member-price').val()));
    $('#member-price').on('keyup', function () {
      this.value = formatRupiah(this.value);
    });
  });

  function formatRupiah(value) {
    let number_string = value.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        
    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return rupiah;
  }
</script>
@endpush