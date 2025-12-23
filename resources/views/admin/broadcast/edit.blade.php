@extends('layouts.app')

@section('title', 'Edit Broadcast')

@section('content')
<div class="row mb-3">
    <div class="col">
        <h2 class="page-title">Edit Broadcast</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <form action="{{ route('broadcast.update', $broadcast->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label required">Judul</label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                               value="{{ old('judul', $broadcast->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Pesan</label>
                        <textarea name="pesan" rows="5" class="form-control @error('pesan') is-invalid @enderror" required>{{ old('pesan', $broadcast->pesan) }}</textarea>
                        @error('pesan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Tipe</label>
                                <select name="tipe" class="form-select @error('tipe') is-invalid @enderror" required>
                                    <option value="promo" {{ old('tipe', $broadcast->tipe) == 'promo' ? 'selected' : '' }}>Promo</option>
                                    <option value="info" {{ old('tipe', $broadcast->tipe) == 'info' ? 'selected' : '' }}>Info</option>
                                    <option value="pengumuman" {{ old('tipe', $broadcast->tipe) == 'pengumuman' ? 'selected' : '' }}> Pengumuman</option>
                                </select>
                                @error('tipe')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Target Customer</label>
                                <select name="target" class="form-select @error('target') is-invalid @enderror" required>
                                    <option value="all" {{ old('target', $broadcast->target) == 'all' ? 'selected' : '' }}>Semua Customer</option>
                                    <option value="verified" {{ old('target', $broadcast->target) == 'verified' ? 'selected' : '' }}>Customer Verified Saja</option>
                                </select>
                                @error('target')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('broadcast.show', $broadcast->id) }}" class="btn btn-link">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><circle cx="12" cy="14" r="2" /><polyline points="14 4 14 8 8 8 8 4" /></svg>
                        Update Broadcast
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
