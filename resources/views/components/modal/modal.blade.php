@props(['name', 'title'])

<div id="create-modal"
    tabindex="-1"
    :aria-hidden="!show"
    aria-labelledby="modal-{{ $name }}-title"
    role="dialog"
    aria-modal="true"
    role="dialog"
    class="fixed hidden
        inset-0 flex
        items-center
        justify-center
        z-50
        bg-black/50
        backdrop-blur-xs">

    <h2 id="modal-{{ $name }}-title" class="text-2xl font-bold mb-4">{{ $title }}</h2>

    <x-card>
        {{ $slot }}
    </x-card>
</div>
