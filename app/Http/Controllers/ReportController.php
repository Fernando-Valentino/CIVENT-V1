<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    public function index()
    {
        $events = Event::paginate(10);
        return view('admin.events.event', compact('events'));
    }

    public function report(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        $events = Event::whereMonth('event_date', $month)
            ->whereYear('event_date', $year)
            ->paginate(10); // Ganti 10 dengan jumlah item per halaman yang diinginkan

        $noEvents = $events->isEmpty(); // cek apakah event kosong

        return view('admin.events.report', compact('events', 'month', 'year', 'noEvents'));
    }


    public function eventReportPdf($id)
    {
        $event = Event::with('registrations')->findOrFail($id);

        $pdf = PDF::loadView('admin.events.event_report_pdf', compact('event'));

        return $pdf->download('event_report_' . $event->id . '.pdf');
    }

    public function generatePdf(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        $events = Event::whereMonth('event_date', $month)
            ->whereYear('event_date', $year)
            ->with('registrations')
            ->get();

        $noEvents = $events->isEmpty(); // cek apakah event kosong

        $pdf = PDF::loadView('admin.events.report_pdf', compact('events', 'month', 'year', 'noEvents'));

        if ($request->has('pdf')) {
            return $pdf->stream('events_report_' . $month . '_' . $year . '.pdf');
        }

        return view('admin.events.report', compact('events', 'noEvents'));
    }


    public function eventReport($id)
    {
        $event = Event::with('registrations')->findOrFail($id);

        $pdf = PDF::loadView('admin.events.event_report_pdf', compact('event'));

        return $pdf->stream('event_report_' . $event->id . '.pdf');
    }
}
