<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource (READ)
     */
    public function index()
    {
        // Fetch all tasks that are NOT soft-deleted
        $tasks = Task::latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource (CREATE + VALIDATION)
     */
    public function store(Request $request) 
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        Task::create($validated);
        return redirect()->route('tasks.index')->with('success', 'Task Created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource (UPDATE + VALIDATION)
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $task->update($validated);
        return redirect()->route('tasks.index')->with('success', 'Task Updated!');
    }

    /**
     * Remove the specified resource (SOFT DELETE)
     */
    public function destroy(Task $task) 
    {
        $task->delete(); // This triggers soft delete because of the trait in Model
        return back()->with('status', 'Task soft-deleted!');
    }
}