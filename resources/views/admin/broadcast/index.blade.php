@extends('layouts.app')

@section('title', 'Broadcast Notifikasi')

@section('content')
<div class="row mb-3">
    <div class="col">
        <h2 class="page-title">Broadcast Notifikasi</h2>
        <div class="text-muted mt-1">Kirim promo, info, atau pengumuman ke customer</div>
    </div>
    <div class="col-auto">
        <a href="{{ route('broadcast.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
            Buat Broadcast Baru
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Broadcast</h3>
            </div>
            <div class="card-body border-bottom py-3">
                <form method="GET" action="{{ route('broadcast.index') }}" class="row g-2">
                    <div class="col-md-3">
                        <select name="tipe" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Tipe</option>
                            <option value="promo" {{ request('tipe') == 'promo' ? 'selected' : '' }}>Promo</option>
                            <option value="info" {{ request('tipe') == 'info' ? 'selected' : '' }}>Info</option>
                            <option value="pengumuman" {{ request('tipe') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        </select>
                    </div>
                    @if(request('tipe'))
                    <div class="col-md-2">
                        <a href="{{ route('broadcast.index') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>
                    @endif
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tipe</th>
                            <th>Target</th>
                            <th>Status</th>
                            <th>Total Terkirim</th>
                            <th>Dikirim Pada</th>
                            <th class="w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($broadcasts as $index => $broadcast)
                        <tr>
                            <td>{{ $broadcasts->firstItem() + $index }}</td>
                            <td>
                                <div class="font-weight-medium">{{ $broadcast->judul }}</div>
                                <div class="text-muted small">{{ Str::limit($broadcast->pesan, 50) }}</div>
                            </td>
                            <td>
                                @if($broadcast->tipe === 'promo')
                                    <span class="badge bg-success text-white">Promo</span>
                                @elseif($broadcast->tipe === 'info')
                                    <span class="badge bg-info text-white">ℹInfo</span>
                                @else
                                    <span class="badge bg-warning text-white">Pengumuman</span>
                                @endif
                            </td>
                            <td>
                                @if($broadcast->target === 'all')
                                    <span class="badge bg-primary text-white">Semua Customer</span>
                                @else
                                    <span class="badge bg-secondary text-white">Customer Verified</span>
                                @endif
                            </td>
                            <td>
                                @if($broadcast->dikirim_pada)
                                    <span class="badge bg-success text-white">Terkirim</span>
                                @else
                                    <span class="badge bg-warning text-white">Draft</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $broadcast->total_terkirim }}</td>
                            <td class="text-muted">
                                {{ $broadcast->dikirim_pada ? $broadcast->dikirim_pada->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('broadcast.show', $broadcast->id) }}" class="btn btn-sm btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                                    </a>
                                    @if(!$broadcast->dikirim_pada)
                                    <a href="{{ route('broadcast.edit', $broadcast->id) }}" class="btn btn-sm btn-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="empty">
                                    <div class="empty-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" /><line x1="12" y1="12" x2="12" y2="12.01" /><line x1="8" y1="12" x2="8" y2="12.01" /><line x1="16" y1="12" x2="16" y2="12.01" /></svg>
                                    </div>
                                    <p class="empty-title">Belum ada broadcast</p>
                                    <p class="empty-subtitle text-muted">Buat broadcast pertama Anda untuk mengirim notifikasi ke customer</p>
                                    <div class="empty-action">
                                        <a href="{{ route('broadcast.create') }}" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                                            Buat Broadcast
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($broadcasts->hasPages())
            <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-muted">
                    Menampilkan <span>{{ $broadcasts->firstItem() }}</span> sampai <span>{{ $broadcasts->lastItem() }}</span> dari <span>{{ $broadcasts->total() }}</span> data
                </p>
                <ul class="pagination m-0 ms-auto">
                    {{ $broadcasts->appends(request()->query())->links() }}
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
