<?php


test('a user can create an idea', function () {
    /** @var \Tests\TestCase $this */
    $this->actingAs(\App\Models\User::factory()->create());
    visit('/ideas')
        ->click('create-modal-button')
        ->debug();
    });
