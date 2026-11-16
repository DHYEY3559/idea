@props(['is' => 'a'])

<{{ $is }} {{ $attributes(['class' => 'border border-border bg-color rounded-lg p-4 md:test-sm']) }}>
    {{ $slot }}
</{{ $is }}>
