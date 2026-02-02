@extends('layouts.app')

@section('title','Dashboard Guru')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Dashboard Guru</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rekap Hari Ini</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Siswa</th>
                            <th>Kelas</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rekap as $row)
                            <tr>
                                <td>{{ $row->tanggal?->format('Y-m-d') }}</td>
                                <td>{{ $row->siswa?->nama ?? '-' }}</td>
                                <td>{{ $row->siswa?->kelas?->nama_kelas ?? '-' }}</td>
                                <td class="text-capitalize">{{ $row->status }}</td>
                                <td>{{ $row->keterangan ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted">Tidak ada data hari ini</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
