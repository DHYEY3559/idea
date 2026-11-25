@props(['is' => 'a'])

<{{ $is }} {{ $attributes->merge(['class' => 'block border border-border/80 bg-card/85 rounded-2xl p-5 shadow-sm backdrop-blur-sm transition-all duration-200']) }}>
    {{ $slot }}
</{{ $is }}>
