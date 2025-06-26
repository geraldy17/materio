@extends('layouts/contentNavbarLayout')

@section('title', 'Departemen')

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
<!-- Judul halaman -->
<h4 class="py-3 mb-4"><span class="text-muted fw-light"></span> Departemen</h4>

<!-- Formulir untuk menambah dan mengedit departemen -->
<div class="row mb-4">
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('departemen.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="department_name">Nama Departemen:</label>
            <input type="text" class="form-control" id="nama_departemen" name="nama_departemen" required>
          </div>
           <div class="form-group">
            <label for="kepala_departemen">Kepala Departemen:</label>
            <select name="kepala_departemen" id="" class="form-control">
              <option value="" disabled selected>Pilih Kepala Departemen</option>
              @foreach ($users as $user)
              <option value="{{$user->name}}">{{$user->name}}</option>
              @endforeach
            </select>
            <!-- <input type="text" class="form-control" id="department_name" name="department_name" required> -->
          </div>
          
          <div class="form-group">
            <label for="department_status">Status:</label>
            <select class="form-control" id="department_status" name="department_status">
              <option value="Aktif">--Pilih Status--</option>
              <option value="Aktif">Aktif</option>
              <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
          </div>
          <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Tabel untuk menampilkan data departemen -->
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Departemen</th>
              <th>Kepala Departemen</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($departemen as $department)
            <tr>
              <td>{{ $department->id }}</td>    
              <td>{{ $department->nama_departemen}}</td>
              <td>{{ $department->kepala_departemen}}</td>
              <td>{{ $department->status}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
