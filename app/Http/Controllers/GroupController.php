<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $groups = $user->groups()->with('creator')->get();
        
        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        
        return view('groups.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'members' => 'array',
            'members.*' => 'exists:users,id',
            'is_announcement' => 'boolean'
        ]);

        $group = Group::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => Auth::id(),
            'is_announcement' => $request->is_announcement ?? false
        ]);

        // Add creator as admin
        $group->users()->attach(Auth::id(), ['is_admin' => true]);

        // Add selected members
        if ($request->has('members')) {
            foreach ($request->members as $memberId) {
                $group->users()->attach($memberId, ['is_admin' => false]);
            }
        }

        return redirect()->route('groups.index')->with('success', 'Group created successfully');
    }

    public function show($id)
    {
        $group = Group::with(['users', 'messages' => function ($query) {
            $query->with('sender')->orderBy('created_at', 'asc');
        }])->findOrFail($id);

        // Check if user is a member
        if (!$group->users->contains(Auth::id())) {
            return back()->with('error', 'You are not a member of this group');
        }

        return view('groups.show', compact('group'));
    }

    public function addMember(Request $request, $groupId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $group = Group::findOrFail($groupId);
        
        if (!$group->users->where('id', Auth::id())->where('pivot.is_admin', true)->exists()) {
            return back()->with('error', 'Only group admins can add members');
        }

        $group->users()->attach($request->user_id, ['is_admin' => false]);

        return back()->with('success', 'Member added successfully');
    }
}
