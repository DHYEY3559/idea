<?php

use App\Models\User;


test('a user can create an idea', function () {
    /** @var \Tests\TestCase $this */
    $this->actingAs($user = User::factory()->create());
    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'My First Idea')
        ->click('@status-button-completed')
        ->fill('description', 'This is my first idea description.')
        ->fill('new-link', 'http://localhost:8000/ideas')
        ->click('add-link')
        ->press('Create Idea')
        ->assertPathIs('/ideas');

    expect($user->ideas()->first())->toMatchArray([
        'title' => 'My First Idea',
        'status' => 'completed',
        'description' => 'This is my first idea description.',
        'links' => ['http://localhost:8000/ideas'],
        ]);
    });
