@props(['name', 'title'])

<div id="{{ $name }}-modal"
    tabindex="-1"
    aria-hidden="true"
    aria-labelledby="modal-{{ $name }}-title"
    role="dialog"
    aria-modal="true"
    class="fixed inset-0 z-50 flex hidden items-center justify-center bg-black/70 p-4 backdrop-blur-md">

    <div class="border-border bg-card relative flex max-h-[90vh] w-full max-w-2xl flex-col overflow-hidden rounded-2xl border shadow-2xl">
        <div class="border-border/80 flex items-center justify-between border-b px-6 py-4">
            <h2 id="modal-{{ $name }}-title" class="text-xl font-bold tracking-tight">{{ $title }}</h2>
            <button type="button"
                class="{{ $name }}-modal-close text-muted-foreground hover:text-foreground hover:bg-white/8 flex size-8 items-center justify-center rounded-lg text-xl leading-none transition-colors"
                aria-label="Close modal">
                &times;
            </button>
        </div>

        <div class="overflow-y-auto p-6">
            {{ $slot }}
        </div>
    </div>
</div>
