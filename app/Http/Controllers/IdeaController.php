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
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $ideas = $user
                ->ideas()
                ->when($request->status, fn($query, $status) => $query->where('status', $status));

        $counts = $user
            ->ideas()
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $StatusCounts = collect(IdeaStatus::cases())
                    ->mapWithKeys(fn($status)
                    => [$status->value => $counts->get($status->value, 0)
                    ])
                    ->pull('all', $user->ideas()->count());


        return view('ideas.index', [
            'ideas' => $ideas,
            'statusCounts' => $StatusCounts,
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
        //
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
        //
    }
}
