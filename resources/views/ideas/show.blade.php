<x-layout>
    <div class="flex flex-col gap-y-4 py-8 mx-auto">

        <div class="flex gap-x-2 items-center">
            <x-icons.back_arrow class="inline-block h-4 w-4" />
            <a href="/ideas" class="font-medium text-xl">Back</a>
        </div>

        <h1 class="text-2xl font-bold">{{ $idea->title }}</h1>
        <x-card>
            <div class="text-foreground max-w-none cursor-pointer">
                {{ $idea->description }}
            </div>
            <p class="text-sm text-gray-500">Created at: {{ $idea->created_at->format('Y-m-d H:i:s') }}</p>
        </x-card>
    </div>
</x-layout>
