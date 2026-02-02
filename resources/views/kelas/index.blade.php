@extends('layouts.app')

@section('title','Data Kelas')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 text-gray-800 mb-0">Data Kelas</h1>
        <a href="{{ route('kelas.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
    </div>

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
                            <th>Nama Kelas</th>
                            <th>Wali Kelas</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $row)
                            <tr>
                                <td>{{ $row->nama_kelas }}</td>
                                <td>{{ $row->wali_kelas }}</td>
                                <td class="text-right">
                                    <a href="{{ route('kelas.edit',$row) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('kelas.destroy',$row) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kelas ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted">Belum ada data</td></tr>
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
