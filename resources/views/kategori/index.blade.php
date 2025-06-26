@extends('layouts/contentNavbarLayout')

@section('title', 'Departemen')

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
<!-- Judul halaman -->
<h4 class="py-3 mb-4"><span class="text-muted fw-light"></span> Kategori</h4>

<!-- Formulir untuk menambah dan mengedit departemen -->
<div class="row mb-4">
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKategoriModal">
          Tambahkan Kategori
        </button>

        <!-- Modal untuk menambah kategori -->
        <div class="modal fade" id="addKategoriModal" tabindex="-1" aria-labelledby="addKategoriModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="{{ route('kategori.store') }}" method="post">
                @csrf
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="addKategoriModalLabel">Form Add Kategori</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="name">Nama Kategori:</label>
                    <input type="text" class="form-control" id="name" name="nama_kategori" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Tabel untuk menampilkan kategori -->
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nama Kategori</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($kategori as $item)
            <tr>
              <td>{{ $item->nama_kategori }}</td>
              <td>
                <!-- Button trigger modal untuk edit -->
                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#editKategoriModal{{ $item->id }}">
                  <i class="bx bx-edit"></i> Edit
                </button>

                <!-- Modal untuk edit kategori -->
                <div class="modal fade" id="editKategoriModal{{ $item->id }}" tabindex="-1" aria-labelledby="editKategoriModalLabel{{ $item->id }}" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form action="{{ route('kategori.update', $item->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="editKategoriModalLabel{{ $item->id }}">Edit Kategori</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="name">Nama Kategori:</label>
                            <input type="text" class="form-control" id="name" name="nama_kategori" value="{{ $item->nama_kategori }}" required>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- Form untuk delete kategori -->
                <form action="{{ route('kategori.destroy', $item->id) }}" method="post" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this category?')">
                    <i class="bx bx-trash"></i> Delete
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
