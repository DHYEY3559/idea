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

            $stepids = $attributes['steps_ids'] ?? [];
            $stepDescriptions = $attributes['steps'] ?? [];


            $existingSteps = $this->idea->steps()->pluck('id')->toArray();
            $submittedStepIds = array_filter($stepids);


            $stepsToDelete = array_diff($existingSteps, $submittedStepIds);

            if(!empty($stepsToDelete)){
                $this->idea->steps()->whereIn('id', $stepsToDelete)->delete();
            }

            foreach ($stepDescriptions as $index => $description){
                $stepId = $stepIds[$index] ?? null;

                if($stepId && in_array($stepId, $existingSteps)){
                    $this->idea->steps()->where('id', $stepId)->update(['description' => $description]);
                }
                else{
                    $this->idea->steps()->create(['description' => $description]);
                }
            }

            if (isset($attributes['links'])) {
                $this->idea->update(['links' => $attributes['links']]);
            }
            
        });

    }
}
