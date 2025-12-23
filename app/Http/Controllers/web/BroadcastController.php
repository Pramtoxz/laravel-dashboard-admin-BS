<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Broadcast;
use App\Models\User;
use App\Services\FCMService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BroadcastController extends Controller
{
    protected $fcmService;

    public function __construct(FCMService $fcmService)
    {
        $this->fcmService = $fcmService;
    }

    public function index(Request $request)
    {
        $query = Broadcast::with('pengirim');

        if ($request->has('tipe') && $request->tipe != '') {
            $query->where('tipe', $request->tipe);
        }

        $broadcasts = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.broadcast.index', compact('broadcasts'));
    }

    public function create()
    {
        return view('admin.broadcast.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
            'tipe' => 'required|in:promo,info,pengumuman',
            'target' => 'required|in:all,verified',
        ]);

        $broadcast = Broadcast::create([
            'judul' => $request->judul,
            'pesan' => $request->pesan,
            'tipe' => $request->tipe,
            'target' => $request->target,
            'dikirim_oleh' => Auth::id(),
        ]);

        return redirect()->route('broadcast.show', $broadcast->id)
            ->with('success', 'Broadcast berhasil dibuat. Klik tombol kirim untuk mengirim notifikasi.');
    }

    public function show($id)
    {
        $broadcast = Broadcast::with('pengirim')->findOrFail($id);
        return view('admin.broadcast.show', compact('broadcast'));
    }

    public function edit($id)
    {
        $broadcast = Broadcast::findOrFail($id);
        
        if ($broadcast->dikirim_pada) {
            return redirect()->route('broadcast.show', $id)
                ->with('error', 'Broadcast yang sudah dikirim tidak bisa diedit');
        }

        return view('admin.broadcast.edit', compact('broadcast'));
    }

    public function update(Request $request, $id)
    {
        $broadcast = Broadcast::findOrFail($id);

        if ($broadcast->dikirim_pada) {
            return redirect()->route('broadcast.show', $id)
                ->with('error', 'Broadcast yang sudah dikirim tidak bisa diedit');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
            'tipe' => 'required|in:promo,info,pengumuman',
            'target' => 'required|in:all,verified',
        ]);

        $broadcast->update([
            'judul' => $request->judul,
            'pesan' => $request->pesan,
            'tipe' => $request->tipe,
            'target' => $request->target,
        ]);

        return redirect()->route('broadcast.show', $id)
            ->with('success', 'Broadcast berhasil diupdate');
    }

    public function destroy($id)
    {
        $broadcast = Broadcast::findOrFail($id);

        if ($broadcast->dikirim_pada) {
            return redirect()->route('broadcast.index')
                ->with('error', 'Broadcast yang sudah dikirim tidak bisa dihapus');
        }

        $broadcast->delete();

        return redirect()->route('broadcast.index')
            ->with('success', 'Broadcast berhasil dihapus');
    }

    public function send($id)
    {
        $broadcast = Broadcast::findOrFail($id);

        if ($broadcast->dikirim_pada) {
            return redirect()->route('broadcast.show', $id)
                ->with('error', 'Broadcast sudah pernah dikirim');
        }

        // Ambil customer berdasarkan target
        $query = User::where('role', 'customer')->whereNotNull('fcm_token');

        if ($broadcast->target === 'verified') {
            $query->where('status_verifikasi', 'verified');
        }

        $customers = $query->get();

        if ($customers->isEmpty()) {
            return redirect()->route('broadcast.show', $id)
                ->with('error', 'Tidak ada customer dengan FCM token yang aktif');
        }

        // Emoji berdasarkan tipe
        $emoji = [
            'promo' => '🎉',
            'info' => 'ℹ️',
            'pengumuman' => '📢',
        ];

        $title = $emoji[$broadcast->tipe] . ' ' . $broadcast->judul;

        $totalTerkirim = 0;

        // Kirim notifikasi ke setiap customer
        foreach ($customers as $customer) {
            $result = $this->fcmService->sendNotification(
                $customer->fcm_token,
                $title,
                $broadcast->pesan,
                [
                    'type' => 'broadcast',
                    'broadcast_id' => $broadcast->id,
                    'tipe' => $broadcast->tipe,
                ]
            );

            if ($result) {
                $totalTerkirim++;
            }
        }

        // Update broadcast
        $broadcast->update([
            'total_terkirim' => $totalTerkirim,
            'dikirim_pada' => now(),
        ]);

        return redirect()->route('broadcast.show', $id)
            ->with('success', "Broadcast berhasil dikirim ke {$totalTerkirim} customer");
    }
}
