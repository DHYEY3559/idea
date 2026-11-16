@props(['label'=>'false', 'name', 'type' => 'text'])

<div class="flex flex-col gap-0.5" {{ $attributes }}>

    @if($label)
    <label
        for="{{ $name }}"
        class="label mb-1">
        {{ $label }}
    </label>
    @endif

    @if($type === 'textarea')
        <textarea
            name="{{ $name }}"
            id="{{ $name }}"
            class="input
                rounded-2xl
                w-full
                h-64
                focus:ring-2
                focus:ring-primary"
                placeholder="{{ $label }}"
            {{ $attributes }}>{{ old($name) }}</textarea>
    @else
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        class="input
            rounded-2xl
            focus:ring-2
            focus:ring-primary"
            placeholder="{{ $label }}"
        value="{{ old($name) }}"
        {{ $attributes }}>
    <x-form.error name="{{ $name }}" class="text-error text-sm" />

    @endif

</div>
