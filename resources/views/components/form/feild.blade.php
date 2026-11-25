@props(['label' => false, 'name', 'type' => 'text'])

<div class="flex flex-col gap-1.5">
    @if ($label)
        <label for="{{ $name }}" class="label">
            {{ $label }}
        </label>
    @endif

    @if ($type === 'textarea')
        <textarea
            name="{{ $name }}"
            id="{{ $name }}"
            {{ $attributes->merge(['class' => 'textarea', 'placeholder' => $label]) }}>{{ old($name) }}</textarea>
        <x-form.error name="{{ $name }}" class="text-error text-xs" />
    @else
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ old($name) }}"
            {{ $attributes->merge(['class' => 'input', 'placeholder' => $label]) }}>
        <x-form.error name="{{ $name }}" class="text-error text-xs" />
    @endif
</div>
