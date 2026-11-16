<div id="create-modal" tabindex="-1" :aria-hidden="!show" role="dialog" aria-modal="true" role="dialog"
    class="fixed hidden inset-0 flex items-center justify-center z-50 bg-black/50 backdrop-blur-xs">

    <x-card>
        {{ $slot }}
    </x-card>
</div>
