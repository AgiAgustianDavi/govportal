<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Complaint::count(),
            'menunggu' => Complaint::where('status', Complaint::STATUS_MENUNGGU)->count(),
            'diproses' => Complaint::where('status', Complaint::STATUS_DIPROSES)->count(),
            'selesai' => Complaint::where('status', Complaint::STATUS_SELESAI)->count(),
            'ditolak' => Complaint::where('status', Complaint::STATUS_DITOLAK)->count(),
        ];

        $recentComplaints = Complaint::with('category')->latest()->take(8)->get();

        return view('admin.dashboard', compact('stats', 'recentComplaints'));
    }
}
