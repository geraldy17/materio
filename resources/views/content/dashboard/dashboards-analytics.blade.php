@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
<script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
<div class="row gy-4">
  <div class="col-12">
    <div class="card shadow-sm border-light">
      <div class="card-body">
        <h4 class="card-title text-primary mb-3">Agenda</h4>
        <div class="table-responsive">
          <table class="table table-hover table-bordered table-striped">
            <thead class="table-light">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($schedule as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->start_time }}</td>
                  <td>{{ $item->end_time }}</td>
                  <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                  <td>
                    @php
                      $agendaDate = \Carbon\Carbon::parse($item->date);
                      $currentDate = \Carbon\Carbon::now();
                      $submissionClosedDate = $agendaDate->addDay();
                    @endphp

                    @if ($currentDate->greaterThan($submissionClosedDate))
                      <button class="btn btn-outline-secondary btn-sm" disabled>Agenda Closed</button>
                    @else
                      <a href="/MenuAgenda" class="btn btn-outline-primary btn-sm">Masuk Ke Agenda</a>
                      <a href="/status" class="btn btn-outline-secondary btn-sm">Masuk Ke Status</a>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
