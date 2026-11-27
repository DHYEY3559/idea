<?php

use App\Models\Idea;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

test('a user can create an idea through the browser', function () {
    Storage::fake('public');

    /** @var TestCase $this */
    $this->actingAs($user = User::factory()->create());

    $imagePath = sys_get_temp_dir().'/idea-browser-test.png';

    file_put_contents(
        $imagePath,
        base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=')
    );

    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'My First Idea')
        ->click('@status-button-completed')
        ->fill('description', 'This is my first idea description.')
        ->fill('new-link', 'http://localhost:8000/ideas')
        ->click('add-link')
        ->attach('image', $imagePath)
        ->fill('new-step', 'Do a thing')
        ->click('add-step')
        ->fill('new-step', 'Do a thing part 2')
        ->click('add-step')
        ->press('Create Idea')
        ->assertPathIs('/ideas');

    $idea = $user->ideas()->firstOrFail();

    expect($idea->toArray())->toMatchArray([
        'title' => 'My First Idea',
        'status' => 'completed',
        'description' => 'This is my first idea description.',
        'links' => ['http://localhost:8000/ideas'],
        'image_path' => $idea->image_path,
        'user_id' => $user->id,
    ]);

    expect($idea->steps)->toHaveCount(2);
});

it('a user can edit their idea', function () {
    /** @var TestCase $this */
    $this->actingAs($user = User::factory()->create());

     $imagePath = sys_get_temp_dir().'/idea-browser-test.png';

    file_put_contents(
        $imagePath,
        base64_decode('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')
    );

    $idea = Idea::factory()->for($user)->create();

    visit(route('ideas.show', $idea))
        ->click('@edit-idea-button')
        ->fill('title', 'My First Idea')
        ->click('@status-button-completed')
        ->fill('description', 'This is my first idea description.')
        ->fill('new-link-edit', 'http://localhost:8000/ideas')
        ->click('add-link')
        ->attach('image', $imagePath)
        ->fill('new-step-edit', 'Do a thing')
        ->click('add-step-button')
        ->fill('new-step-edit', 'Do a thing part 2')
        ->click('add-step-button')
        ->press('Update Idea')
        ->assertPathIs('/ideas');

    $idea = $user->ideas()->firstOrFail();

    expect($idea->toArray())->toMatchArray([
        'title' => 'My First Idea',
        'status' => 'completed',
        'description' => 'This is my first idea description.',
        'image_path' => $idea->image_path,
        'user_id' => $user->id,
    ]);

    expect($idea->steps)->toHaveCount(2);
});
