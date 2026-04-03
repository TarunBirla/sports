<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matches;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserMatch;

class MatchController extends Controller
{
   public function upcomingMatches()
    {
        $matches = auth()->user()
            ->matches()
            ->where('status', 'upcoming') // relation
            ->orderBy('match_date', 'asc')
            ->get();

        return view('dashboard.matches', compact('matches'));
    }
    // 📌 Show all matches created by vendor
    public function index()
    {
        $vendorId = auth()->id();

        $matches = Matches::where('created_by', $vendorId)
                        ->latest()
                        ->get();

        return view('vendor.matches.index', compact('matches'));
    }

    // 📌 Show create form
    public function create()
    {
        $trainerId = session('vendor_id') ?? auth()->id();
        $userIds=Payment::where('vendor_id', $trainerId)->pluck('user_id');
        $users = User::whereIn('id', $userIds)->get();
        return view('vendor.matches.create', compact('users'));
    }

    // 📌 Store match + assign users
    public function store(Request $request)
    {
        $request->validate([
            'match_date' => 'required|date',
            'opponent_team' => 'required|string',
            'venue' => 'required|string',
            'match_type' => 'required|in:T20,ODI,TEST',
            'users' => 'required|array'
        ]);

        $vendorId = auth()->id();

        // ✅ Create Match
        $match = Matches::create([
            'match_date' => $request->match_date,
            'opponent_team' => $request->opponent_team,
            'venue' => $request->venue,
            'match_type' => $request->match_type,
            'created_by' => $vendorId,
        ]);

        // ✅ Assign users
        foreach ($request->users as $userId) {
            UserMatch::create([
                'user_id' => $userId,
                'match_id' => $match->id,
                'assigned_by' => $vendorId,
            ]);
        }

        return redirect()->route('vendor.matches.index')
                         ->with('success', 'Match created successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:upcoming,complete',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi|max:20480' // 20MB
        ]);

        $match = Matches::findOrFail($id);

        $videoPath = null;

        // ✅ If file uploaded
        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');

            // Create unique name
            $filename = time() . '_' . $file->getClientOriginalName();

            // Move to public folder
            $file->move(public_path('match_videos'), $filename);

            $videoPath = 'match_videos/' . $filename; // save this in DB
        }

        // ✅ If URL provided
        if ($request->video_url) {
            $videoPath = $request->video_url;
        }

        // ✅ Update match
        $match->update([
            'status' => $request->status,
            'video_url' => $videoPath
        ]);

        return back()->with('success', 'Match status updated successfully');
    }

    // 📌 Edit Page
    public function edit($id)
    {
        $match = Matches::findOrFail($id);

        $trainerId = session('vendor_id') ?? auth()->id();
        $userIds=Payment::where('vendor_id', $trainerId)->pluck('user_id');
        $users = User::whereIn('id', $userIds)->get();

        // already assigned users
        $assignedUsers = $match->users->pluck('id')->toArray();

        return view('vendor.matches.edit', compact('match', 'users', 'assignedUsers'));
    }

    // 📌 Update Match
    public function update(Request $request, $id)
    {
        $request->validate([
            'match_date' => 'required|date',
            'opponent_team' => 'required|string',
            'venue' => 'required|string',
            'match_type' => 'required|in:T20,ODI,TEST',
            'users' => 'required|array'
        ]);

        $match = Matches::findOrFail($id);

        $match->update([
            'match_date' => $request->match_date,
            'opponent_team' => $request->opponent_team,
            'venue' => $request->venue,
            'match_type' => $request->match_type,
        ]);

        // ✅ Sync users (remove old + add new)
        $syncData = [];
        foreach ($request->users as $userId) {
            $syncData[$userId] = ['assigned_by' => auth()->id()];
        }

        $match->users()->sync($syncData);

        return redirect()->route('vendor.matches.index')
                        ->with('success', 'Match updated successfully');
    }
}