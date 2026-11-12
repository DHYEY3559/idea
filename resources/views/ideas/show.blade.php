<x-layout>
    <div class="mt-10 p-10 max-w-3xl flex flex-col gap-y-4">
        <h1 class="text-2xl font-bold">{{ $idea->title }}</h1>
        <p class="text-lg">{{ $idea->description }}</p>
        <p class="text-sm text-gray-500">Created at: {{ $idea->created_at->format('Y-m-d H:i:s') }}</p>
    </div>
</x-layout>
