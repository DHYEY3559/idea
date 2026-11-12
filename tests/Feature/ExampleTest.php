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
});
