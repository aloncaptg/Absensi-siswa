@extends('layouts.app')

@section('title', isset($guruAbsensi) ? 'Edit Absensi Guru' : 'Tambah Absensi Guru')

@section('content')
    <h1 class="h3 text-gray-800 mb-4">{{ isset($guruAbsensi) ? 'Edit' : 'Tambah' }} Absensi Guru</h1>
    <div class="card shadow">
        <div class="card-body">
            <form method="POST" action="{{ isset($guruAbsensi) ? route('guru-absensi.update',$guruAbsensi) : route('guru-absensi.store') }}">
                @csrf
                @if(isset($guruAbsensi)) @method('PUT') @endif

                <div class="form-group">
                    <label>Nama Guru</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', auth()->user()->isGuru() ? optional(auth()->user()->guru)->nama : (isset($guruAbsensi) ? optional($guruAbsensi->guru)->nama : '')) }}" {{ auth()->user()->isGuru() ? 'readonly' : '' }} required>
                    @error('nama')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', optional($guruAbsensi->tanggal ?? null)->format('Y-m-d') ?? now()->toDateString()) }}" required>
                    @error('tanggal')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        @foreach (['hadir'=>'Hadir','izin'=>'Izin','sakit'=>'Sakit','alpha'=>'Alpha'] as $k=>$v)
                            <option value="{{ $k }}" {{ old('status', $guruAbsensi->status ?? '') == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                    @error('status')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $guruAbsensi->keterangan ?? '') }}</textarea>
                </div>

                <div>
                    <a href="{{ route('guru-absensi.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

