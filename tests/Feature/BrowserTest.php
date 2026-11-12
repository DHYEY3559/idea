<?php

use Illuminate\Support\Facades\Auth;

test('the application registers User', function () {
    visit('/register')
        ->type('name', 'John Doe')
        ->type('email', 'john@example.com')
        ->type('password', 'password123')
        ->press('Create Account')
        ->assertPathIs('/');

    expect(Auth::check())->toBeTrue();
    expect(Auth::user()->name)->toBe('John Doe');
    expect(session('success'))->toBe('You are logged in!');
});

test('the application logs in User', function () {
    $user = \App\Models\User::factory()->create([
        'email' => 'david@example.com',
        'password' => bcrypt('password123')
    ]);

    visit('/login')
        ->type('email', 'david@example.com')
        ->type('password', 'password123')
        ->press('Login')
        ->assertPathIs('/');

    expect(Auth::check())->toBeTrue();
    expect(session('success'))->toBe('You are logged in!');
});
