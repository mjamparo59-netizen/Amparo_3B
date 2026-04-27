<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Required for Activity 5

class NoteController extends Controller
{
    /**
     * Display only the notes belonging to the authenticated user.
     */
    public function index()
    {
        return view('notes.index', [
            // Correctly using 'userId' to match your custom migration
            'notes' => Note::where('user_id', Auth::id())->latest()->get()
        ]);
    }

    /**
     * Store a new note and link it to the current user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        // Activity 5 Implementation:
        // This uses the relationship in User.php to set the userId automatically
        Auth::user()->notes()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return back();
    }

    /**
     * Update the note, but only if the user owns it.
     */
    public function update(Request $request, Note $note)
    {
        // Security check using your custom 'userId' column
        if ($note->user_id!== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $note->update($request->all());
        return back();
    }

    /**
     * Delete the note, but only if the user owns it.
     */
    public function destroy(Note $note)
    {
        // Security check using your custom 'userId' column
        if ($note->user_id!== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $note->delete();
        return back();
    }

    /**
     * Dashboard view for Activity 4
     */
    public function dashboard()
    {
        // Pulls notes via the Eloquent relationship
        $notes = Auth::user()->notes;
        return view('dashboard', compact('notes'));
    }
}