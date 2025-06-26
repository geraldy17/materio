@extends('layouts/contentNavbarLayout')

@section('title', 'Menu Agenda')

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
<!-- Judul halaman -->
<h4 class="py-3 mb-4">Menu Agenda</h4>

<!-- Formulir untuk menambah dan mengedit agenda -->
<div class="row mb-4">
  <div class="col-lg-12">
    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('menuagenda.store') }}" method="POST">
          @csrf
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="jadwal_id">Jadwal ID:</label>
              <select class="form-control" id="schedule_id" name="schedule_id" required>
                <option value="" disabled selected>--Pilih Jadwal ID--</option>
                @foreach($schedule as $sian)
                  <option value="{{$sian->id}}">{{ $sian->id }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="nama_kategori">Nama Kategori:</label>
              <select class="form-control" id="nama_kategori" name="kategori_id" required>
                <option value="" disabled selected>--Pilih Kategori--</option>
                @foreach($kategori as $sial)
                  <option value="{{$sial->id}}">{{ $sial->nama_kategori }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="judul">Judul:</label>
            <input type="text" class="form-control" id="judul" name="judul" required placeholder="Masukkan judul agenda">
          </div>
          <div class="form-group">
            <label for="latar_belakang_keputusan">Latar Belakang Pelaksanaan:</label>
            <textarea class="form-control" id="latar_belakang_keputusan" name="latar_belakang_keputusan" required placeholder="Masukkan latar belakang pelaksanaan"></textarea>
          </div>
          <div class="form-group">
            <label for="keputusan_komite">Keputusan Komite:</label>
            <textarea class="form-control" id="keputusan_komite" name="keputusan_komite" required placeholder="Masukkan keputusan komite"></textarea>
          </div>
          <div class="form-group">
            <label for="tempat">Tempat:</label>
            <input type="text" class="form-control" id="tempat" name="tempat" required placeholder="Masukkan tempat pelaksanaan">
          </div>
          <div class="form-group">
            <label for="biaya">Biaya:</label>
            <input type="number" class="form-control" id="biaya" name="biaya" required placeholder="Masukkan biaya">
          </div>
          <div class="form-group">
            <label for="rincian_biaya">Rincian Biaya:</label>
            <textarea class="form-control" id="rincian_biaya" name="rincian_biaya" required placeholder="Masukkan rincian biaya"></textarea>
          </div>
          <div class="form-group">
            <label for="panitia">Panitia:</label>
            <input type="text" class="form-control" id="panitia" name="panitia" required placeholder="Masukkan nama panitia">
          </div>
          <div class="form-group">
            <label for="peserta">Peserta:</label>
            <input type="text" class="form-control" id="peserta" name="peserta" required placeholder="Masukkan nama peserta">
          </div>
          <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary btn-block">Create</button>

             <a href="/status" class="btn btn-primary btn-block">Masuk Ke Status</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Tabel untuk menampilkan data agenda -->
<div class="row">
  <div class="col-lg-12">
    <div class="card shadow-sm">
      <div class="card-body">
        <table class="table table-hover table-striped table-bordered">
          <thead>
            <tr class="table-primary">
              <th>Jadwal ID</th>
              <th>Nama Kategori</th>
              <th>Nama </th>
              <th>Judul</th>
              <th>Latar belakang keputusan</th>
              <th>Keputusan Komite</th>
              <th>Tempat</th>
              <th>Biaya</th>
              <th>Rincian Biaya</th>
              <th>Panitia</th>
              <th>Peserta</th>
            </tr>
          </thead>
          <tbody>
            @foreach($menu_agenda as $MenuAgenda)
              <tr>
                <td>{{$MenuAgenda['schedule_id']}}</td>
                <td>{{$MenuAgenda->kategori->nama_kategori}}</td>
                <td>{{$MenuAgenda->user->name}}</td>
                <td>{{$MenuAgenda['judul']}}</td>
                <td>{{$MenuAgenda['latar_belakang_keputusan']}}</td>
                <td>{{$MenuAgenda['keputusan_komite']}}</td>
                <td>{{$MenuAgenda['tempat']}}</td>
                <td>{{$MenuAgenda['biaya']}}</td>
                <td>{{$MenuAgenda['rincian_biaya']}}</td>
                <td>{{$MenuAgenda['panitia']}}</td>
                <td>{{$MenuAgenda['peserta']}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
  
