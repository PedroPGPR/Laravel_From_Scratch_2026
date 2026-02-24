<x-layout>
    <form method="POST" action="/ideas">
        @csrf
        <div class="col-span-full">
            <label for="idea" class="block text-sm/6 font-medium text-white">New Idea</label>
            <div class="mt-2">
                <textarea id="idea" name="idea" rows="3" placeholder="Describe your idea..."
                    class="textarea w-full @error('idea') textarea-error @enderror"></textarea>
                <x-forms.error name="idea" />
            </div>
            <p class="mt-3 text-sm/6 text-gray-400">Have an idea for later?</p>
        </div>

        <div class="mt-6 flex items-center gap-x-6">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</x-layout>
