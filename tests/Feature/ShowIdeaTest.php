<?php

use App\Models\Idea;

it('Requirement is Authentication', function () {
    $idea = Idea::factory()->create();

    /** @var \Tests\TestCase $this */
    $this->get(Route('ideas.show', $idea))
        ->assertRedirect(Route('login'));
});
