@extends('layouts.main')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <h3>Daftar Produk</h3>
  <a href="{{ route('products.create') }}" class="btn btn-primary">
    <i class="fa-solid fa-plus fa-sm me-1"></i>
    Tambah Produk
  </a>
</div>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table" id="datatable">
        <thead>
          <tr>
            <th style="width: 10%">Gambar</th>
            <th style="width: 28%">Nama</th>
            <th>Stok</th>
            <th>Harga Normal</th>
            <th>Harga Member</th>
            <th style="width: 12%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
            <tr>
              <td>
                <img class="rounded table-img" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
              </td>
              <td>{{ $product->name }}</td>
              <td>{{ $product->stock }}</td>
              <td>@currency($product->normal_price)</td>
              <td>@currency($product->member_price)</td>
              <td>
                <div class="d-flex align-items-center">
                  <a href="{{ route('products.edit', $product->id) }}" class="btn badge text-bg-secondary me-1">Edit</a>
                  <form action="{{ route('products.destroy', $product->id) }}" method="POST" id="delete-form" style="margin-top: -3px">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn badge text-bg-danger" id="delete-btn" onclick="deleteProduct(this)">Hapus</button>
                  </form>
                </div>
                {{-- <div class="btn-group btn-group-sm align-items-center" role="group">
                  <button type="button" class="btn btn-outline-secondary">Lihat</button>
                  <form action="{{ route('products.destroy', $product->id) }}" method="POST" id="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-danger btn-sm rounded-start-0" id="delete-btn" style="margin-left: -1px" onclick="deleteProduct(this)">Hapus</button>
                  </form>
                </div> --}}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function () {
    $('#datatable').DataTable();
  });

  const customSwal = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-outline-primary px-4 me-3",
      cancelButton: "btn btn-outline-danger px-4",
    },
    buttonsStyling: false
  });

  function deleteProduct(target) {
    customSwal.fire({
      title: "Apakah anda yakin?",
      text: "Tindakan ini tidak dapat dikembalikan",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yakin",
      cancelButtonText: "Tidak",
    }).then((result) => {
      if (result.isConfirmed) {
        $(target).parent().submit();
      } else if (
        result.dismiss === Swal.DismissReason.cancel
      ) {
        Swal.close();
      }
    });
  }
</script>
@endpush