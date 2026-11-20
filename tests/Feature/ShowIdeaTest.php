<?php

use App\Models\Idea;
use App\Models\User;
use Tests\TestCase;

it('Requirement is Authentication', function () {
    $idea = Idea::factory()->create();

    /** @var TestCase $this */
    $this->get(Route('ideas.show', $idea))
        ->assertRedirect(Route('login'));
});

it('Requirement is Authorization', function () {
    $idea = Idea::factory()->create();

    /** @var TestCase $this */
    $this->actingAs($user = User::factory()->create())
        ->get(Route('ideas.show', $idea))
        ->assertForbidden();
});
