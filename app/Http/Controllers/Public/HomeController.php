<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $announcements = Announcement::published()->latest('published_at')->take(3)->get();
        $categories = Category::withCount('complaints')->take(5)->get();

        return view('public.home', compact('announcements', 'categories'));
    }

    public function services()
    {
        $categories = Category::all();

        return view('public.services', compact('categories'));
    }

    public function about()
    {
        return view('public.about');
    }
}
