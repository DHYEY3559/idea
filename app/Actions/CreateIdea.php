<?php
namespace App\Actions;
use Illuminate\Support\Facades\Auth;

class CreateIdea
{
    public function handle(array $data)
    {
        $idea = new \App\Models\Idea();
        $idea->title = $data['title'];
        $idea->user_id = Auth::id();
        $idea->description = $data['description'] ?? null;
        $idea->status = $data['status'] ?? 'pending';
        $idea->links = $data['links'] ?? [];
        $idea->save();


        return $idea;
    }
}

