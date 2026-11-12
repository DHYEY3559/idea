@props(['status' => 'pending'])

@php
    $classes = 'text-sm rounded-full px-2 py-1';

    if ($status == 'pending') {
        $classes .= ' bg-yellow-500/10 border border-yellow-500/20 text-yellow-500';
    } elseif ($status == 'in-progress') {
        $classes .= ' bg-blue-500/10 border border-blue-500/20 text-blue-500';
    } elseif ($status == 'completed') {
        $classes .= ' bg-green-500/10 border border-green-500/20 text-green-500';
    }
@endphp

<div>
    <span class="{{ $classes }}">{{ $slot }}</span>
</div>
