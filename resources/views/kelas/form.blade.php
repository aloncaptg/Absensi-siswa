@extends('layouts.app')

@section('title', isset($kelas) ? 'Edit Kelas' : 'Tambah Kelas')

@section('content')
    <h1 class="h3 text-gray-800 mb-4">{{ isset($kelas) ? 'Edit' : 'Tambah' }} Kelas</h1>
    <div class="card shadow">
        <div class="card-body">
            <form method="POST" action="{{ isset($kelas) ? route('kelas.update',$kelas) : route('kelas.store') }}">
                @csrf
                @if(isset($kelas)) @method('PUT') @endif

                <div class="form-group">
                    <label>Nama Kelas</label>
                    <input type="text" name="nama_kelas" class="form-control" value="{{ old('nama_kelas', $kelas->nama_kelas ?? '') }}" required>
                    @error('nama_kelas')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Wali Kelas</label>
                    <input type="text" name="wali_kelas" class="form-control" value="{{ old('wali_kelas', $kelas->wali_kelas ?? '') }}" required>
                    @error('wali_kelas')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div>
                    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
