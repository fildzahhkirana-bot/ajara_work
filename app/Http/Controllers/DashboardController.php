<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Competition::query()->where('status', 'published');
        if ($request->filled('q')) {
            $term = $request->q;
            $query->where(fn ($q) => $q->where('title', 'like', "%{$term}%")
                ->orWhere('organizer', 'like', "%{$term}%"));
        }
        if ($request->filled('category') && $request->category !== 'Semua') {
            $query->where('category', $request->category);
        }

        $competitions = $query->latest()->take(6)->get();
        return view('dashboard', compact('competitions'));
    }
}
