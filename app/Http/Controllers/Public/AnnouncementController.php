<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::published()->latest('published_at')->paginate(8);

        return view('public.announcements.index', compact('announcements'));
    }

    public function show(Announcement $announcement)
    {
        abort_unless($announcement->published_at && $announcement->published_at->isPast(), 404);

        return view('public.announcements.show', compact('announcement'));
    }
}
