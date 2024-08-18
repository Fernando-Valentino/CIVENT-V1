<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class EventController extends Controller
{

    public function participants($id)
    {
        $event = Event::with('registrations.user')->findOrFail($id);
        return view('admin.events.participants', compact('event'));
    }

    public function viewAttendees(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $search = $request->input('search');

        $attendees = $event->registrations()
            ->with('user')
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('registration_id', 'LIKE', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('nim', 'LIKE', "%{$search}%");
                    });
                });
            })
            ->join('users', 'event_registrations.user_id', '=', 'users.id')  // Join the users table
            ->orderBy('users.name')  // Order by the name from the users table
            ->select('event_registrations.*')  // Select all columns from event_registrations
            ->get();

        return view('admin.events.attendees', compact('event', 'attendees'));
    }



    public function destroyAttendee($id)
    {
        $registration = EventRegistration::find($id);

        if ($registration) {
            $event = $registration->event;
            $event->quota += 1;  // Restore the quota
            $event->save();

            $registration->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }



    // Menampilkan form untuk membuat event
    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required|date_format:H:i',
            'event_end_time' => 'required|date_format:H:i|after:event_time',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
            'quota' => 'required|integer|min:1', // Tambahkan validasi quota
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = date('Y-m-d') . '.' . $image->getClientOriginalName();
            $imagePath = '/images/events/' . $imageName;
            Storage::disk('public')->put(
                $imagePath,
                file_get_contents($image)
            );
        }

        $event = Event::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'event_date' => $validatedData['event_date'],
            'event_time' => $validatedData['event_time'],
            'event_end_time' => $validatedData['event_end_time'],
            'location' => $validatedData['location'],
            'image' => $imageName,
            'user_id' => auth()->id(),
            'quota' => $validatedData['quota'], // Simpan quota
        ]);



        return redirect()->route('admin.events.create')->with('success', 'Event has been created!');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required|date_format:H:i',
            'event_end_time' => 'required|date_format:H:i|after:event_time',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
            'quota' => 'required|integer|min:1',
        ]);

        $event = Event::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image) {
                Storage::disk('public')->delete('/images/events/' . $event->image);
            }

            $image = $request->file('image');
            $imageName = date('Y-m-d') . '.' . $image->getClientOriginalName();
            $imagePath = '/images/events/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
            $event->image = $imageName;
        }

        $event->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'event_date' => $validatedData['event_date'],
            'event_time' => $validatedData['event_time'],
            'event_end_time' => $validatedData['event_end_time'],
            'location' => $validatedData['location'],
            'quota' => $validatedData['quota'],
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event has been updated!');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Menghapus gambar jika ada
        if ($event->image) {
            Storage::disk('public')->delete('/images/events/' . $event->image);
        }

        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event has been deleted!');
    }


    public function showDetailEvent($id)
    {
        $event = Event::findOrFail($id);
        $registrations = EventRegistration::where('user_id', Auth::id())->get();

        // Generate the registration ID using current date and time including seconds
        $abbreviation = strtoupper(substr($event->title, 0, 3));
        $currentDate = Carbon::now()->format('Ymd');
        $currentTime = Carbon::now()->format('His'); // Include seconds
        $registrationId = $abbreviation . $currentDate . $currentTime;

        return view('user.show', compact('event', 'registrations', 'registrationId'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'email' => 'required|email',
            'event_id' => 'required',
            'registration_id' => 'required|unique:event_registrations,registration_id',
        ]);

        $event = Event::findOrFail($request->event_id);

        // Cek apakah kuota sudah penuh
        if ($event->registered_participants >= $event->quota) {
            return redirect()->route('events.show', $event->id)->with('error', 'The event is fully booked. Registration is closed.');
        }

        $eventDate = Carbon::parse($event->event_date);
        $eventTime = Carbon::parse($event->event_time)->format('H:i');
        $eventStartDateTime = $eventDate->setTimeFromTimeString($eventTime);
        $currentDateTime = Carbon::now();

        // Cek apakah event sudah lewat
        if ($currentDateTime->greaterThanOrEqualTo($eventStartDateTime)) {
            return redirect()->route('events.show', $event->id)->with('error', 'The event has already passed. Registration is closed.');
        }

        // Cek apakah pendaftaran dilakukan kurang dari 3 jam sebelum waktu event
        $threeHoursBeforeEvent = $eventStartDateTime->copy()->subHours(3);
        if ($currentDateTime->greaterThan($threeHoursBeforeEvent)) {
            return redirect()->route('events.show', $event->id)->with('error', 'Registration is only allowed up to 3 hours before the event.');
        }

        // Cek jika user sudah mendaftar
        $existingRegistration = EventRegistration::where('user_id', Auth::id())
            ->where('event_id', $request->event_id)
            ->first();

        if ($existingRegistration) {
            return redirect()->route('events.show', $request->event_id)->with('error', 'You have already registered for this event.');
        }

        EventRegistration::create([
            'registration_id' => $request->registration_id,
            'user_id' => Auth::id(),
            'event_id' => $request->event_id,
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
        ]);

        // Tambah jumlah peserta yang sudah mendaftar
        $event->increment('registered_participants');

        return redirect()->route('events.show', $request->event_id)->with('success', 'Registration successful!');
    }


    public function myEvents()
    {
        $registrations = EventRegistration::with('event')->where('user_id', Auth::id())->get();

        return view('user.myevents', compact('registrations'));
    }

    public function cancelRegistration(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        $event = Event::find($request->event_id);
        $currentDate = Carbon::now();
        $eventDate = Carbon::parse($event->event_date);

        // Cek jika pembatalan dilakukan kurang dari 3 hari sebelum acara
        if ($eventDate->diffInDays($currentDate) < 3) {
            return redirect()->route('events.myEvents')->with('error', 'You can only cancel registration up to 3 days before the event.');
        }

        $registration = EventRegistration::where('user_id', Auth::id())
            ->where('event_id', $request->event_id)
            ->first();

        if ($registration) {
            $registration->delete();
            return redirect()->route('events.myEvents')->with('success', 'Registration canceled successfully.');
        }

        return redirect()->route('events.myEvents')->with('error', 'You are not registered for this event.');
    }

    public function detailMyEvent($id)
    {
        $event = Event::with(['participants' => function ($query) {
            $query->where('user_id', Auth::id());
        }])->findOrFail($id);

        return view('user.detail_myevent', compact('event'));
    }
}
