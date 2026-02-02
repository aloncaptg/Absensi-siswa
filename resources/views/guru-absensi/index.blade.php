@extends('layouts.app')

@section('title','Data Absensi Guru')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 text-gray-800 mb-0">Data Absensi Guru</h1>
        <div>
            <a href="{{ route('laporan.guru') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-list"></i> Laporan</a>
            <a href="{{ route('laporan.guru.pdf') }}" class="btn btn-outline-danger btn-sm"><i class="fas fa-file-pdf"></i> PDF</a>
            <a href="{{ route('guru-absensi.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
        </div>
    </div>

    <form method="GET" class="card shadow mb-3">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label>Nama Guru</label>
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari nama guru...">
                </div>
                <div class="form-group col-md-4 align-self-end">
                    <button class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
                    <a href="{{ route('guru-absensi.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </div>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Guru</th>
                            <th>NIP</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $row)
                            <tr>
                                <td>{{ $row->tanggal?->format('Y-m-d') }}</td>
                                <td>{{ $row->guru?->nama ?? '-' }}</td>
                                <td>{{ $row->guru?->nip ?? '-' }}</td>
                                <td class="text-capitalize">{{ $row->status }}</td>
                                <td>{{ $row->keterangan ?? '-' }}</td>
                                <td class="text-right">
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('guru-absensi.edit',$row) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('guru-absensi.destroy',$row) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    @else
                                        <span class="text-muted small">(Hanya admin yang dapat mengedit)</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if(method_exists($data,'links'))
            <div class="card-footer">{{ $data->links() }}</div>
        @endif
    </div>
@endsection

