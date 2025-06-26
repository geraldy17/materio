@extends('layouts/contentNavbarLayout')

@section('title', 'Departemen')

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
<!-- Judul halaman -->
<h4 class="py-3 mb-4">Schedule</h4>

<!-- Formulir untuk menambah dan mengedit departemen -->
<div class="row mb-4">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
          Tambahkan Schedule
        </button>

        <!-- Add Schedule Modal -->
        <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="{{ route('schedule.store') }}" method="post">
                @csrf
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="addScheduleModalLabel">Form Add Schedule</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="form-group mb-3">
                    <label for="name">Nama Schedule:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                  <div class="form-group mb-3">
                    <label for="tanggal">Tanggal:</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                  </div>
                  <div class="form-group mb-3">
                    <label for="buka_agenda">Buka Agenda:</label>
                    <input type="date" class="form-control" id="buka_agenda" name="buka_agenda" required>
                  </div>
                  <div class="form-group mb-3">
                    <label for="tutup_agenda">Tutup Agenda:</label>
                    <input type="date" class="form-control" id="tutup_agenda" name="tutup_agenda" required>
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

<!-- Tabel untuk menampilkan data schedule -->
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <table class="table table-striped table-responsive">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Tanggal</th>
              <th>Buka Agenda</th>
              <th>Tutup Agenda</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($schedule as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->date }}</td>
                <td>{{ $item->start_time }}</td>
                <td>{{ $item->end_time }}</td>
                <td>
                  <!-- Button trigger edit modal -->
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editScheduleModal{{ $item->id }}">
                    Edit
                  </button>

                  <!-- Edit Schedule Modal -->
                  <div class="modal fade" id="editScheduleModal{{ $item->id }}" tabindex="-1" aria-labelledby="editScheduleModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="{{ route('schedule.update', $item->id) }}" method="post">
                          @csrf
                          @method('PUT')
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editScheduleModalLabel{{ $item->id }}">Edit Schedule</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group mb-3">
                              <label for="name">Nama Schedule:</label>
                              <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
                            </div>
                            <div class="form-group mb-3">
                              <label for="tanggal">Tanggal:</label>
                              <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $item->tanggal }}" required>
                            </div>
                            <div class="form-group mb-3">
                              <label for="buka_agenda">Buka Agenda:</label>
                              <input type="date" class="form-control" id="buka_agenda" name="buka_agenda" value="{{ $item->buka_agenda }}" required>
                            </div>
                            <div class="form-group mb-3">
                              <label for="tutup_agenda">Tutup Agenda:</label>
                              <input type="date" class="form-control" id="tutup_agenda" name="tutup_agenda" value="{{ $item->tutup_agenda }}" required>
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

                  <form action="{{ route('schedule.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $schedule->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
