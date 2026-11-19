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

it('a user can edit their idea', function(){
    /** @var TestCase $this */
    $this->actingAs($user = User::factory()->create());

    $idea = Idea::factory()->for($user)->create();

    visit(route('ideas.show', $idea))
        ->click('@edit-idea-button')
        ->debug();
    //     ->fill('title', 'My First Idea')
    //     ->click('@status-button-completed')
    //     ->fill('description', 'This is my first idea description.')
    //     ->fill('new-link', 'http://localhost:8000/ideas')
    //     ->click('add-link')
    //     ->attach('image', $imagePath)
    //     ->fill('new-step', 'Do a thing')
    //     ->click('add-step')
    //     ->fill('new-step', 'Do a thing part 2')
    //     ->click('add-step')
    //     ->press('Create Idea')
    //     ->assertPathIs('/ideas');

    // $idea = $user->ideas()->firstOrFail();

    // expect($idea->toArray())->toMatchArray([
    //     'title' => 'My First Idea',
    //     'status' => 'completed',
    //     'description' => 'This is my first idea description.',
    //     'links' => ['http://localhost:8000/ideas'],
    //     'image_path' => $idea->image_path,
    //     'user_id' => $user->id,
    // ]);

    // expect($idea->steps)->toHaveCount(2);
});
