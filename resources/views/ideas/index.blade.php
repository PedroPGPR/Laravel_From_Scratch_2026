
<x-layout>
    @if ($ideas->count() > 0)
        <div class="mt-6 text-white">
            <h2 class="font-bold text-lg">Your Ideas</h2>
            <ul class="list-inside list-disc">
                @foreach ($ideas as $idea)
                    <li class="hover:underline hover:text-blue-300">
                        <a href="/ideas/{{ $idea->id }}" class="mt-2 text-sm">{{ $idea->description }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="/ideas/create">
        <button class="mt-5 rounded-md bg-blue-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500">
            Add Idea
        </button>
    </a>
</x-layout>
