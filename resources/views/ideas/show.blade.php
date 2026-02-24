<x-layout>
    <div class="mt-6 text-white">
        <h2 class="font-bold text-lg">Your Idea</h2>
        <p>{{ $idea->description }}</p>
    </div>

    <div class="mt-6 flex items-center gap-x-6">
        <a href="/ideas/{{ $idea->id }}/edit">
            <button
                type="submit"
                class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
            >
                Update
            </button>
        </a>
    </div>
</x-layout>
