@props(['status' => 'pending'])

@php
    $badgeClasses = 'inline-flex items-center gap-1.5 text-xs font-medium rounded-full px-2.5 py-1 border';
    $dotClasses = 'size-1.5 rounded-full';

    if ($status === 'pending') {
        $badgeClasses .= ' bg-amber-500/10 border-amber-500/25 text-amber-400';
        $dotClasses .= ' bg-amber-400';
    } elseif ($status === 'in_progress') {
        $badgeClasses .= ' bg-sky-500/10 border-sky-500/25 text-sky-400';
        $dotClasses .= ' bg-sky-400';
    } elseif ($status === 'completed') {
        $badgeClasses .= ' bg-primary/10 border-primary/25 text-primary';
        $dotClasses .= ' bg-primary';
    } else {
        $badgeClasses .= ' bg-white/5 border-border text-muted-foreground';
        $dotClasses .= ' bg-muted-foreground';
    }
@endphp

<div class="inline-flex">
    <span class="{{ $badgeClasses }}">
        <span class="{{ $dotClasses }}"></span>
        {{ $slot }}
    </span>
</div>
