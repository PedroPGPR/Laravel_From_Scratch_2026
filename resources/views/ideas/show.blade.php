<x-layout>
    <div class="card bg-neutral-800 p-6 mt-6 text-white">
        <p>{{ $idea->description }}</p>
        <div class="mt-6 flex items-center gap-x-6">
            <a href="/ideas/{{ $idea->id }}/edit">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
            </a>
        </div>
    </div>

</x-layout>
