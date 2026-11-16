@props(['label', 'name', 'type' => 'text'])

<div class="flex flex-col gap-0.5" {{ $attributes }}>
    <label for="{{ $name }}" class="label mb-1">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        class="input rounded-2xl focus:ring-2 focus:ring-primary" placeholder="{{ $label }}" />
</div>
