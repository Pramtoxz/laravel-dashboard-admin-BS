@extends('layouts.app')

@section('title', 'Detail Broadcast')

@section('content')
<div class="row mb-3">
    <div class="col">
        <h2 class="page-title">Detail Broadcast</h2>
    </div>
    <div class="col-auto">
        <a href="{{ route('broadcast.index') }}" class="btn btn-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="5" y1="12" x2="19" y2="12" /><line x1="5" y1="12" x2="11" y2="18" /><line x1="5" y1="12" x2="11" y2="6" /></svg>
            Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Broadcast</h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3 text-muted">Judul:</div>
                    <div class="col-md-9"><strong>{{ $broadcast->judul }}</strong></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-muted">Pesan:</div>
                    <div class="col-md-9">{{ $broadcast->pesan }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-muted">Tipe:</div>
                    <div class="col-md-9">
                        @if($broadcast->tipe === 'promo')
                            <span class="badge bg-success">🎉 Promo</span>
                        @elseif($broadcast->tipe === 'info')
                            <span class="badge bg-info">ℹ️ Info</span>
                        @else
                            <span class="badge bg-warning">📢 Pengumuman</span>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-muted">Target:</div>
                    <div class="col-md-9">
                        @if($broadcast->target === 'all')
                            <span class="badge bg-primary">Semua Customer</span>
                        @else
                            <span class="badge bg-secondary">Customer Verified</span>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-muted">Status:</div>
                    <div class="col-md-9">
                        @if($broadcast->dikirim_pada)
                            <span class="badge bg-success">Terkirim</span>
                        @else
                            <span class="badge bg-warning">Draft</span>
                        @endif
                    </div>
                </div>
                @if($broadcast->dikirim_pada)
                <div class="row mb-3">
                    <div class="col-md-3 text-muted">Total Terkirim:</div>
                    <div class="col-md-9"><strong>{{ $broadcast->total_terkirim }}</strong> customer</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-muted">Dikirim Pada:</div>
                    <div class="col-md-9">{{ $broadcast->dikirim_pada->format('d F Y, H:i') }} WIB</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-muted">Dikirim Oleh:</div>
                    <div class="col-md-9">{{ $broadcast->pengirim->name ?? '-' }}</div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-3 text-muted">Dibuat Pada:</div>
                    <div class="col-md-9">{{ $broadcast->created_at->format('d F Y, H:i') }} WIB</div>
                </div>
            </div>
            @if(!$broadcast->dikirim_pada)
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ route('broadcast.edit', $broadcast->id) }}" class="btn btn-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                            Edit
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            Hapus
                        </button>
                    </div>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#sendModal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="10" y1="14" x2="21" y2="3" /><path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                        Kirim Sekarang
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Preview Notifikasi</h3>
            </div>
            <div class="card-body">
                <div class="border rounded p-3" style="background-color: #f8f9fa;">
                    <div class="d-flex align-items-start">
                        <div class="me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                        </div>
                        <div class="flex-fill">
                            <div class="fw-bold">
                                @if($broadcast->tipe === 'promo')
                                    🎉
                                @elseif($broadcast->tipe === 'info')
                                    ℹ️
                                @else
                                    📢
                                @endif
                                {{ $broadcast->judul }}
                            </div>
                            <div class="text-muted small mt-1">{{ $broadcast->pesan }}</div>
                            <div class="text-muted small mt-2">Baru saja</div>
                        </div>
                    </div>
                </div>
                <div class="text-muted small mt-2">
                    <em>Ini adalah preview tampilan notifikasi di HP customer</em>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Kirim -->
<div class="modal modal-blur fade" id="sendModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Kirim Broadcast</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('broadcast.send', $broadcast->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin mengirim broadcast ini?</p>
                    <div class="alert alert-info">
                        <strong>Target:</strong> {{ $broadcast->target === 'all' ? 'Semua Customer' : 'Customer Verified' }}<br>
                        <strong>Catatan:</strong> Broadcast yang sudah dikirim tidak bisa dibatalkan atau diedit.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Ya, Kirim Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal modal-blur fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('broadcast.destroy', $broadcast->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus broadcast ini?</p>
                    <div class="alert alert-warning">
                        <strong>Peringatan:</strong> Data yang dihapus tidak dapat dikembalikan.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
