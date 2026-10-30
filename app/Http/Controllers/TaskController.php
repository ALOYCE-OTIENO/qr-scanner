<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get tasks created by user
        $myCreatedTasks = $user->createdTasks()->with(['creator', 'assignee'])->orderBy('created_at', 'desc')->get();
        
        // Get tasks assigned to user
        $myAssignedTasks = $user->assignedTasks()->with(['creator', 'assignee'])->orderBy('created_at', 'desc')->get();

        return view('tasks.index', compact('myCreatedTasks', 'myAssignedTasks'));
    }

    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'assignee_id' => 'nullable|exists:users,id',
            'priority' => 'required|in:low,medium,high,urgent',
            'due_date' => 'nullable|date|after:today'
        ]);

        Task::create([
            'creator_id' => Auth::id(),
            'assignee_id' => $request->assignee_id,
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 'pending',
            'due_date' => $request->due_date
        ]);

        // Notify assignee if set
        if ($request->assignee_id) {
            \App\Models\Notification::create([
                'user_id' => $request->assignee_id,
                'title' => 'New Task Assigned',
                'message' => "You have been assigned a new task: {$request->title}",
                'type' => 'system',
                'is_read' => false
            ]);
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    public function show($id)
    {
        $task = Task::with(['creator', 'assignee'])->findOrFail($id);
        
        // Check if user is creator or assignee
        if ($task->creator_id !== Auth::id() && $task->assignee_id !== Auth::id() && !Auth::user()->isAdmin()) {
            return back()->with('error', 'You are not authorized to view this task');
        }

        return view('tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users = User::where('id', '!=', Auth::id())->get();
        
        if ($task->creator_id !== Auth::id() && !Auth::user()->isAdmin()) {
            return back()->with('error', 'You are not authorized to edit this task');
        }

        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        
        if ($task->creator_id !== Auth::id() && !Auth::user()->isAdmin()) {
            return back()->with('error', 'You are not authorized to edit this task');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'assignee_id' => 'nullable|exists:users,id',
            'priority' => 'required|in:low,medium,high,urgent',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in_progress,completed,cancelled'
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'assignee_id' => $request->assignee_id,
            'priority' => $request->priority,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'completed_at' => $request->status === 'completed' ? now() : null
        ]);

        return redirect()->route('tasks.show', $task->id)->with('success', 'Task updated successfully');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        
        if ($task->creator_id !== Auth::id() && !Auth::user()->isAdmin()) {
            return back()->with('error', 'You are not authorized to delete this task');
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        
        if ($task->assignee_id !== Auth::id() && $task->creator_id !== Auth::id() && !Auth::user()->isAdmin()) {
            return back()->with('error', 'You are not authorized to update this task');
        }

        $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled'
        ]);

        $task->update([
            'status' => $request->status,
            'completed_at' => $request->status === 'completed' ? now() : null
        ]);

        // Notify creator if status changed by assignee
        if ($task->assignee_id === Auth::id() && $task->creator_id !== Auth::id()) {
            \App\Models\Notification::create([
                'user_id' => $task->creator_id,
                'title' => 'Task Status Updated',
                'message' => "Task '{$task->title}' status changed to {$request->status}",
                'type' => 'system',
                'is_read' => false
            ]);
        }

        return back()->with('success', 'Task status updated successfully');
    }
}
