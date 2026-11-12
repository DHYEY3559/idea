@props(['label', 'name'])

<div class="flex flex-col gap-0.5" {{ $attributes }}>
    <label for="{{ $name }}" class="label mb-1">{{ $label }}</label>
    <input type="{{ $name }}" name="{{ $name }}" id="{{ $name }}"
        class="input rounded-2xl focus:ring-2 focus:ring-primary" placeholder="{{ $label }}" />
</div>
