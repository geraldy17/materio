@extends('layouts/contentNavbarLayout')

@section('title', 'Departemen')

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
<!-- Judul halaman -->
<h4 class="py-3 mb-4"><span class="text-muted fw-light"></span> List Agenda</h4>

<!-- Tabel untuk menampilkan data departemen -->
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Jadwal </th>
              <th>Kategori </th>
              <th>Judul</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($agenda as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->schedule_id }}</td>
                    <td>{{ $item->kategori_id }}</td>
                    <td>{{ $item->judul }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
