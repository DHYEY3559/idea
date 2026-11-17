<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use Illuminate\Http\Request;
use App\IdeaStatus;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Idea $idea)
    {

        $ideas = Auth::user()
                ->ideas()
                ->when(in_array($request->status, IdeaStatus::values()), fn($query) => $query->where('status', $request->status))
                ->latest()
                ->get();



        return view('ideas.index', [
            'ideas' => $ideas,
            'statusCounts' =>Idea::statusCounts(Auth::user()),
        ]);

        // SELECT status, COUNT(*) AS Count FROM `ideas` GROUP BY status;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIdeaRequest $request)
    {
        $validated = $request->validated();

        $idea = new Idea();
        $idea->title = $validated['title'];
        $idea->user_id = Auth::id();
        $idea->description = $validated['description'] ?? null;
        $idea->status = $validated['status'] ?? 'pending';
        $idea->links = $validated['links'] ?? '';
        $idea->save();

        return redirect()->route('ideas.index')->with('success', 'Idea created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        return view('ideas.show', [
            'idea' => $idea,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIdeaRequest $request, Idea $idea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        $idea->delete();

        return redirect()->route('ideas.index')->with('success', 'Idea deleted successfully.');
    }
}
