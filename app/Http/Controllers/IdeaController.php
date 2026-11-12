<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ideas = Auth::user()->ideas;

        return view('ideas.index', [
            'ideas' => $ideas,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        $ideas = DB::query()
            ->select('id', 'title', 'description')
            ->from('ideas')
            ->where('id', $idea->id)
            ->first();

        return view('ideas.show', [
            'idea' => $ideas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        $ideas = DB::query()
            ->select('id', 'title', 'description')
            ->from('ideas')
            ->where('id', $idea->id)
            ->first();
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
        //
    }
}
