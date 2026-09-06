<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::with('category', 'assignedTo')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $complaints = $query->paginate(10)->withQueryString();
        $statuses = Complaint::$statuses;

        return view('admin.complaints.index', compact('complaints', 'statuses'));
    }

    public function show(Complaint $complaint)
    {
        $complaint->load('category', 'responses.user', 'assignedTo');
        $petugas = User::whereIn('role', [User::ROLE_ADMIN, User::ROLE_PETUGAS])->get();
        $statuses = Complaint::$statuses;

        return view('admin.complaints.show', compact('complaint', 'petugas', 'statuses'));
    }

    public function updateStatus(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:menunggu,diproses,selesai,ditolak'],
            'assigned_to' => ['nullable', 'exists:users,id'],
        ]);

        $complaint->update($validated);

        return back()->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    public function respond(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'min:5'],
        ]);

        $complaint->responses()->create([
            'user_id' => $request->user()->id,
            'message' => $validated['message'],
        ]);

        return back()->with('success', 'Tanggapan berhasil dikirim.');
    }
}
