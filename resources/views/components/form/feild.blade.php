@props(['label'=> false, 'name', 'type'=>'text'])

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
            class="input focus:ring-primary h-24 w-full rounded-2xl focus:ring-2"
            placeholder="{{ $label }}"
            {{ $attributes }}>{{ old($name) }}</textarea>
        <x-form.error name="{{ $name }}" class="text-error text-sm" />
    @else
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            class="input focus:ring-primary rounded-2xl focus:ring-2"
            placeholder="{{ $label }}"
            value="{{ old($name) }}"
            {{ $attributes }}>
        <x-form.error name="{{ $name }}" class="text-error text-sm" />

    @endif

</div>
