@extends('layouts.app')

@section('title', isset($absensi) ? 'Edit Absensi' : 'Tambah Absensi')

@section('content')
    <h1 class="h3 text-gray-800 mb-4">{{ isset($absensi) ? 'Edit' : 'Tambah' }} Absensi</h1>
    <div class="card shadow">
        <div class="card-body">
            <form method="POST" action="{{ isset($absensi) ? route('absensi.update',$absensi) : route('absensi.store') }}">
                @csrf
                @if(isset($absensi)) @method('PUT') @endif

                <div class="form-group">
                    <label>Kelas</label>
                    <select name="kelas" class="form-control" required>
                        @foreach(($kelasOptions ?? []) as $k)
                            <option value="{{ $k }}" {{ old('kelas', isset($absensi) && optional($absensi->siswa->kelas)->nama_kelas ? optional($absensi->siswa->kelas)->nama_kelas : '') == $k ? 'selected' : '' }}>{{ $k }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama Siswa</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', auth()->user()->isSiswa() ? auth()->user()->name : (isset($absensi) ? optional($absensi->siswa)->nama : '')) }}" {{ auth()->user()->isSiswa() ? 'readonly' : '' }} required>
                    @error('nama')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', optional($absensi->tanggal ?? null)->format('Y-m-d') ?? now()->toDateString()) }}" required>
                    @error('tanggal')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        @foreach (['hadir'=>'Hadir','izin'=>'Izin','sakit'=>'Sakit','alpha'=>'Alpha'] as $k=>$v)
                            <option value="{{ $k }}" {{ old('status', $absensi->status ?? '') == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                    @error('status')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $absensi->keterangan ?? '') }}</textarea>
                </div>

                <div>
                    @if(auth()->user()->isSiswa())
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
                    @else
                        <a href="{{ route('absensi.index') }}" class="btn btn-secondary">Kembali</a>
                    @endif
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
