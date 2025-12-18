<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Mobil;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'mobil']);

        if ($request->has('status_pembayaran') && $request->status_pembayaran != '') {
            $query->where('status_pembayaran', $request->status_pembayaran);
        }

        if ($request->has('status_booking') && $request->status_booking != '') {
            $query->where('status_booking', $request->status_booking);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_booking', 'ILIKE', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'ILIKE', "%{$search}%");
                    })
                    ->orWhereHas('mobil', function ($q) use ($search) {
                        $q->where('nama_mobil', 'ILIKE', "%{$search}%");
                    });
            });
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.booking.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::with(['user', 'mobil'])->findOrFail($id);
        return view('admin.booking.show', compact('booking'));
    }

    public function verifyPayment(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:verified,rejected',
            'catatan_admin' => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($id);

        if ($request->status === 'verified') {
            $booking->update([
                'status_pembayaran' => 'verified',
                'status_booking' => 'confirmed',
                'catatan_admin' => $request->catatan_admin,
                'verified_at' => now(),
            ]);

            // Update status mobil jika hari ini adalah hari mulai
            if ($booking->tanggal_mulai->isToday()) {
                $booking->mobil->update(['status' => 'disewa']);
            }

            $message = 'Pembayaran berhasil diverifikasi';
        } else {
            $booking->update([
                'status_pembayaran' => 'rejected',
                'status_booking' => 'cancelled',
                'catatan_admin' => $request->catatan_admin,
            ]);

            $message = 'Pembayaran ditolak';
        }

        return redirect()->route('booking.show', $id)->with('success', $message);
    }

    public function checkIn($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status_booking !== 'confirmed') {
            return redirect()->back()->with('error', 'Booking belum dikonfirmasi');
        }

        $booking->update([
            'status_booking' => 'checked_in',
            'checked_in_at' => now(),
        ]);

        $booking->mobil->update(['status' => 'disewa']);

        return redirect()->route('booking.show', $id)->with('success', 'Customer berhasil check-in');
    }

    public function complete($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status_booking !== 'checked_in') {
            return redirect()->back()->with('error', 'Booking belum check-in');
        }

        $booking->update([
            'status_booking' => 'completed',
            'completed_at' => now(),
        ]);

        $booking->mobil->update(['status' => 'tersedia']);

        return redirect()->route('booking.show', $id)->with('success', 'Booking selesai, mobil tersedia kembali');
    }
}
