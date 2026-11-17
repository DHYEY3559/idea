@props(['name'])

@error($name)
    <p {{ $attributes->merge(['class' => 'error mt-1']) }}>{{ $message }}</p>
@enderror
