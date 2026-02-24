<x-layout>
    @if ($ideas->count() > 0)
        <div class="mt-6 text-white">
            <h2 class="font-bold text-lg">Your Ideas</h2>
            <ul class="grid grid-cols-2 gap-x-6 gap-y-4 mt-5">
                @foreach ($ideas as $idea)
                    <x-idea-card href="/ideas/{{ $idea->id }}">
                        {{ $idea->description }}
                    </x-idea-card>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="/ideas/create" class="mt-6 inline-block">
        <button class="btn btn-primary">
            Add Idea
        </button>
    </a>
</x-layout>
