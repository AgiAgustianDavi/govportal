<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function create()
    {
        $categories = Category::all();

        return view('public.complaints.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:20'],
            'attachment' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        if ($request->hasFile('attachment')) {
            $validated['attachment_path'] = $request->file('attachment')->store('complaints', 'public');
        }
        unset($validated['attachment']);

        $complaint = Complaint::create($validated);

        return redirect()
            ->route('complaints.submitted', $complaint->ticket_number)
            ->with('success', 'Pengaduan Anda berhasil dikirim.');
    }

    public function submitted(string $ticket)
    {
        $complaint = Complaint::where('ticket_number', $ticket)->firstOrFail();

        return view('public.complaints.submitted', compact('complaint'));
    }

    public function trackForm()
    {
        return view('public.complaints.track');
    }

    public function track(Request $request)
    {
        $request->validate([
            'ticket_number' => ['required', 'string'],
        ]);

        $complaint = Complaint::with(['category', 'responses.user'])
            ->where('ticket_number', $request->ticket_number)
            ->first();

        if (! $complaint) {
            return back()->withErrors([
                'ticket_number' => 'Nomor tiket tidak ditemukan. Periksa kembali nomor tiket Anda.',
            ]);
        }

        return view('public.complaints.result', compact('complaint'));
    }
}
