<?php

use App\Models\Idea;


test('a user can create an idea', function () {
    /** @var \Tests\TestCase $this */
    $this->actingAs(\App\Models\User::factory()->create());
    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'My First Idea')
        ->click('@status-button-completed')
        ->fill('description', 'This is my first idea description.')
        ->press('Create Idea')
        ->assertPathIs('/ideas');

    expect(Idea::count())->toBe(1);
    });
