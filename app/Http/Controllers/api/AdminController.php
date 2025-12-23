<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Services\FCMService;

class AdminController extends Controller
{
    protected $fcmService;

    public function __construct(FCMService $fcmService)
    {
        $this->fcmService = $fcmService;
    }

    // Verifikasi Customer
    public function verifyCustomer(Request $request, $userId)
    {
        $request->validate([
            'status' => 'required|in:verified,rejected',
            'catatan' => 'nullable|string',
        ]);

        $user = User::findOrFail($userId);

        $user->update([
            'status_verifikasi' => $request->status,
            'catatan_verifikasi' => $request->catatan,
        ]);

        // Kirim notifikasi FCM
        $this->fcmService->sendVerificationNotification(
            $user,
            $request->status,
            $request->catatan
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Verifikasi customer berhasil diupdate',
            'data' => $user,
        ]);
    }

    // Verifikasi Pembayaran
    public function verifyPayment(Request $request, $bookingId)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:verified,rejected',
            'catatan_admin' => 'nullable|string',
        ]);

        $booking = Booking::with('user')->findOrFail($bookingId);

        $updateData = [
            'status_pembayaran' => $request->status_pembayaran,
            'catatan_admin' => $request->catatan_admin,
        ];

        if ($request->status_pembayaran === 'verified') {
            $updateData['verified_at'] = now();
            $updateData['status_booking'] = 'verified';
        }

        $booking->update($updateData);

        // Kirim notifikasi FCM
        $this->fcmService->sendPaymentVerificationNotification(
            $booking,
            $request->status_pembayaran,
            $request->catatan_admin
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Verifikasi pembayaran berhasil diupdate',
            'data' => $booking,
        ]);
    }

    // Update Status Booking
    public function updateBookingStatus(Request $request, $bookingId)
    {
        $request->validate([
            'status_booking' => 'required|in:pending,verified,checked_in,completed,cancelled',
            'catatan_admin' => 'nullable|string',
        ]);

        $booking = Booking::with('user')->findOrFail($bookingId);

        $updateData = [
            'status_booking' => $request->status_booking,
            'catatan_admin' => $request->catatan_admin,
        ];

        if ($request->status_booking === 'checked_in') {
            $updateData['checked_in_at'] = now();
        } elseif ($request->status_booking === 'completed') {
            $updateData['completed_at'] = now();
        }

        $booking->update($updateData);

        // Kirim notifikasi FCM
        $messages = [
            'pending' => "Booking {$booking->kode_booking} sedang diproses.",
            'verified' => "Booking {$booking->kode_booking} telah dikonfirmasi. Silakan ambil mobil sesuai jadwal.",
            'checked_in' => "Mobil telah diambil. Selamat berkendara!",
            'completed' => "Terima kasih telah menggunakan layanan kami. Booking {$booking->kode_booking} selesai.",
            'cancelled' => "Booking {$booking->kode_booking} dibatalkan. " . ($request->catatan_admin ?? ''),
        ];

        $this->fcmService->sendBookingStatusNotification(
            $booking,
            $request->status_booking,
            $messages[$request->status_booking]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Status booking berhasil diupdate',
            'data' => $booking,
        ]);
    }

    // List Customer yang perlu diverifikasi
    public function pendingCustomers()
    {
        $customers = User::where('role', 'customer')
            ->where('status_verifikasi', 'pending')
            ->whereNotNull('foto_ktp')
            ->whereNotNull('foto_selfie')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $customers,
        ]);
    }

    // List Pembayaran yang perlu diverifikasi
    public function pendingPayments()
    {
        $bookings = Booking::with(['user', 'mobil'])
            ->where('status_pembayaran', 'pending')
            ->whereNotNull('bukti_bayar')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $bookings,
        ]);
    }
}
