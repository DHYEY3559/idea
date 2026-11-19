<?php

use App\Models\Idea;
use App\Models\User;

it('Requirement is Authentication', function () {
    $idea = Idea::factory()->create();

    /** @var \Tests\TestCase $this */
    $this->get(Route('ideas.show', $idea))
        ->assertRedirect(Route('login'));
});


it('Requirement is Authorization', function () {
    $idea = Idea::factory()->create();

    /** @var \Tests\TestCase $this */
    $this->actingAs($user = User::factory()->create())
        ->get(Route('ideas.show', $idea))
        ->assertForbidden();
});
