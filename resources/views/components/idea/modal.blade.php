@props([
    'idea' => new App\Models\Idea()
])

<x-modal
    name="{{ $idea->exists ? 'edit-idea': 'create-idea' }}"
    title="{{ $idea->exists ? 'Edit idea' : 'Create idea' }}"
>
    <form
        x-data="{
            status: @js(old('status', $idea->status->value)),
            newLink: '',
            links: @js(old('links', $idea->links ?? [])),
            newStep: '',
            steps: @js(old('steps', $idea->steps->pluck('description'))),
        }"
        method="POST"
        action="{{ $idea->exists ? route('ideas.update', $idea) : route('ideas.store') }}"
        enctype="multipart/form-data"
    >
        @csrf
        @if($idea->exists)
            @method('PATCH')
        @endif

        <div class="space-y-6">
            <x-forms.field
                label="Title"
                name="title"
                placeholder="Enter an idea for your title"
                autofocus
                required
                :value="$idea->title"
            />

            <div>
                <label for="status" class="label">Status</label>

                <div class="flex gap-x-3 mt-2">
                    @foreach(App\IdeaStatus::cases() as $status)
                        <button
                            type="button"
                            class="btn flex-1 h-10"
                            :class="{'btn-outlined': status !== @js($status->value)}"
                            @click="status = @js($status->value)"
                            data-test="button-status-{{ $status->value }}"
                        >
                            {{ $status->label() }}
                        </button>
                    @endforeach

                    <input type="hidden" name="status" :value="status"/>
                </div>

                <x-forms.error name="status"/>
            </div>

            <x-forms.field
                label="Description"
                name="description"
                type="textarea"
                placeholder="Describe your idea..."
                :value="$idea->description"
            />

            <div class="space-y-2">
                <label for="image" class="label">Featured Image</label>

                @if($idea->image_path)
                    <div class="">
                        <img src="{{ asset('storage/' . $idea->image_path) }}" alt="Idea Image" class="w-full h-48 object-cover rounded-lg space-y-2">

                        <button form="delete-image-form" class="w-full btn btn-outlined h-10">Remove Image</button>
                    </div>
                @endif

                <input type="file" name="image" id="image" accept="image/*">
                <x-forms.error name="image" />
            </div>

            <div>
                <fieldset class="space-y-3">
                    <legend class="label">Steps</legend>

                    <template x-for="(step, index) in steps" :key="index">
                        <div class="flex gap-x-2 items-center">
                            <input type="text" name="steps[]" x-model="step" class="input"/>

                            <button
                                type="button"
                                @click="steps.splice(index, 1)"
                                data-test="remove-step-button"
                                aria-label="Remove step button"
                                class="form-muted-icon"
                            >
                                <x-icons.close />
                            </button>
                        </div>
                    </template>

                    <div class="flex gap-x-2 items-center">
                        <input
                            x-model="newStep"
                            type="text"
                            id="new-step"
                            placeholder="What needs to be done?"
                            class="input flex-1"
                            spellcheck="false"
                        />

                        <button
                            type="button"
                            class="form-muted-icon"
                            @click="steps.push(newStep.trim()); newStep = ''"
                            data-test="add-step-button"
                            aria-label="Add step button"
                            :disabled="newStep.trim().length === 0"
                        >
                            <x-icons.close class="rotate-45"/>
                        </button>
                    </div>
                </fieldset>
            </div>

            <div>
                <fieldset class="space-y-3">
                    <legend class="label">Links</legend>

                    <template x-for="(link, index) in links" :key="link">
                        <div class="flex gap-x-2 items-center">
                            <input type="text" name="links[]" x-model="link" class="input"/>

                            <button
                                type="button"
                                @click="links.splice(index, 1)"
                                data-test="remove-link-button"
                                aria-label="Remove link button"
                                class="form-muted-icon"
                            >
                                <x-icons.close />
                            </button>
                        </div>
                    </template>

                    <div class="flex gap-x-2 items-center">
                        <input
                            x-model="newLink"
                            type="url"
                            id="new-link"
                            placeholder="http://example.com"
                            autocomplete="url"
                            class="input flex-1"
                            spellcheck="false"
                        />

                        <button
                            type="button"
                            class="form-muted-icon"
                            @click="links.push(newLink.trim()); newLink = ''"
                            data-test="add-link-button"
                            aria-label="Add link button"
                            :disabled="newLink.trim().length === 0"
                        >
                            <x-icons.close class="rotate-45"/>
                        </button>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="flex justify-end gap-x-5 mt-5">
            <button type="button" class="btn btn-outlined" @click="$dispatch('close-modal')">Cancel</button>
            <button type="submit" class="btn" data-test="submit-idea-button">{{ $idea->exists ? 'Update' : 'Create' }}</button>
        </div>
    </form>

    @if($idea->image_path)
        <form method="POST" action="{{ route('ideas.image.destroy', $idea) }}" id="delete-image-form">
            @csrf
            @method('DELETE')
        </form>
    @endif
</x-modal>
