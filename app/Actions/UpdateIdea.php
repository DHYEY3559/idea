<?php

namespace App\Actions;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\DB;

class UpdateIdea
{
    public function __construct(#[CurrentUser()] protected User $user)
    {
        //
    }

    public function handle(Idea $idea, array $attributes)
    {


        // dd(request()->all());
        // $data = array_merge(
        //     collect($attributes)->only(['title', 'description', 'status', 'links' ?? []],
        //     ['title' => '', 'description' => '', 'status' => 'pending', 'links' => []])->toArray()
        // );
        $data = collect($attributes)->only(['title', 'description', 'status', 'links'])->toArray();

        if ($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('images', 'public');
            }
        

        DB::transaction(function () use ($data, $attributes, $idea) {
            $idea->update($data);

            $stepids = $attributes['step_ids'] ?? null;
            $stepDescriptions = $attributes['steps'] ?? [];


            $existingSteps = $idea->steps()->pluck('id')->toArray();
            $submittedStepIds = array_filter($stepids ?? []);
            


            $stepsToDelete = array_diff($existingSteps, $submittedStepIds);

            
            if(!empty($stepsToDelete)){
                $idea->steps()->whereIn('id', $stepsToDelete)->delete();
            }

            

            foreach ($stepDescriptions as $index => $description){
                
                $stepId = $stepids[$index] ?? [];
                

                if($stepId && in_array($stepId, $existingSteps)){
                    //dd(request()->all());
                    $idea->steps()->where('id', $stepId)->update(['description' => $description]);
                }
                else{
                    $idea->steps()->create(['description' => $description]);
                }
            }
            
            if (isset($attributes['links'])) {
                $idea->update(['links' => $attributes['links']]);
            }
            
        });
    
        

    }
}
