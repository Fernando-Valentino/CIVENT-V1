<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\EventRegistration;


class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data events dengan urutan berdasarkan event_date dari yang terbaru, dan menerapkan pagination
        $events = Event::orderBy('created_at', 'desc')->paginate(6); // 6 events per halaman

        // Mengirimkan data events dan status login ke view
        return view('user.dashboard', [
            'events' => $events,
            'isLoggedIn' => Auth::check()
        ]);
    }

    public function dashboard()
    {
        $totalEvents = Event::count();
        $totalParticipants = EventRegistration::count();
        $activeEvents = Event::where('event_date', '>=', now())->count();

        // Generate data for the graph
        $rawRegistrations = EventRegistration::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
        ->groupBy('month')
        ->pluck('count', 'month')->all();

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $monthlyRegistrations = [];

        // Initialize all months with 0
        foreach ($months as $index => $month) {
            $monthlyRegistrations[$index] = $rawRegistrations[$index + 1] ?? 0;
        }

        return view('admin.dashboard', compact('totalEvents', 'totalParticipants', 'activeEvents', 'months', 'monthlyRegistrations'));
    }



    public function search(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'date' => 'nullable|date',
        ]);

        $query = Event::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('event_date', $request->date);
        }

        $events = $query->orderBy('event_date', 'desc')->paginate(10); // 10 events per halaman

        $isLoggedIn = Auth::check();

        return view('user.dashboard', compact('events', 'isLoggedIn'));
    }
}
