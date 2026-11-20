<?php

namespace App\Actions;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\DB;

class UpdateIdea
{
    public function __construct(#[CurrentUser()] protected User $user, protected Idea $idea)
    {
        //
    }

    public function handle(array $attributes)
    {

        $data = array_merge(
            ['title' => '', 'description' => '', 'status' => 'pending', 'links' => []],
            collect($attributes)->only(['title', 'description', 'status', 'links' ?? []])->toArray(),
        );

        if ($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('images', 'public');
        }

        DB::transaction(function () use ($data, $attributes) {
            $this->idea->update($data);

            $this->idea->steps()->updateMany(
                collect($attributes['steps'] ?? [])->map(fn ($step) => ['description' => $step])
            );
        });

    }
}
