<x-layout>
    <div class="flex flex-col gap-y-4 py-8 mx-auto">

        <div class="flex justify-between ">

            <a href="/ideas" class="flex items-center text-xl font-bold">
                <x-icons.back_arrow/>
                Back</a>
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
