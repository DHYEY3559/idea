@props(['name', 'title'])

<div id="create-modal"
    tabindex="-1"
    aria-hidden="true"
    aria-labelledby="modal-{{ $name }}-title"
    role="dialog"
    aria-modal="true"
    role="dialog"
    class="fixed hidden
    inset-0 flex flex-col
    items-center
    justify-center
    z-50
    bg-black/50
    backdrop-blur-xs">

    <div class="flex justify-between">
        <h2 id="modal-{{ $name }}-title" class="mb-4 flex text-2xl font-bold">{{ $title }}</h2>
    </div>

    <x-card class="w-full max-w-2xl font-bold" style="overflow-y: auto;">
        {{ $slot }}
    </x-card>
</div>
