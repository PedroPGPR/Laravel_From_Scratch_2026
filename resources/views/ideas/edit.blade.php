<x-layout>
    <form method="POST" action="/ideas/{{ $idea->id }}">
        @csrf
        @method('PATCH')
        <div class="col-span-full">
            <label for="idea" class="block text-sm/6 font-medium text-white">Edit Your Idea</label>
            <div class="mt-2">
                <textarea id="idea" name="idea" rows="3" class="textarea w-full @error('idea') textarea-error @enderror">{{ $idea->description }}</textarea>
                <x-forms.error name="idea" />
            </div>
            <p class="mt-3 text-sm/6 text-gray-400">Have an idea for later?</p>
        </div>

        <div class="mt-6 flex items-center gap-x-3">
            <button type="submit" class="btn btn-primary">
                Save
            </button>

            <button type="submit" form="delete-idea-form" class="btn btn-error text-white">
                Delete
            </button>
        </div>
    </form>

    <form id="delete-idea-form" action="/ideas/{{ $idea->id }}" method="POST">
        @csrf
        @method('DELETE')
    </form>
</x-layout>
