@php use App\IdeaStatus; @endphp

<x-layout>
    <div>
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>

            <x-card
                x-data
                @click="$dispatch('open-modal', 'create-idea')"
                is="button"
                type="button"
                class="mt-10 space-y-3 cursor-pointer h-32 w-full text-left"
                data-test="create-idea-button"
            >
                <p>What's the idea?</p>
            </x-card>
        </header>

        <div>
            <a href="/ideas" class="btn {{ request('status') ? 'btn-outlined' : '' }}">
                All
                <span class="text-xs ml-3">{{$statusCounts->get('all')}}</span>
            </a>
            @foreach(IdeaStatus::cases() as $status)
                <a
                    href="/ideas?status={{ $status->value }}"
                   class="btn {{ request('status') === $status->value ? '' : 'btn-outlined' }}"
                >
                    {{ $status->label() }}
                    <span class="text-xs ml-3">{{$statusCounts->get($status->value)}}</span>
                </a>
            @endforeach
        </div>

        <div class="mt-10 text-muted-foreground">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse($ideas as $idea)
                    <x-card href="{{ route('ideas.show', $idea) }}">
                        @if($idea->image_path)
                            <div class="mb-4 -mx-4 -mt-4 rounded-t-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $idea->image_path) }}" alt="Idea Image" class="w-full h-auto object-cover">
                            </div>
                        @endif

                        <h3 class="text-foreground text-lg">{{ $idea->title }}</h3>

                        <div class="mt-2">
                            <x-idea.status-label status="{{ $idea->status }}">
                                {{ $idea->status->label() }}
                            </x-idea.status-label>
                        </div>

                        <div class="mt-5 line-clamp-3">{{ $idea->description }}</div>
                        <div class="mt-4">{{ $idea->created_at->diffForHumans() }}</div>
                    </x-card>
                @empty
                    <x-card>
                        <p>No ideas at this time.</p>
                    </x-card>
                @endforelse
            </div>
        </div>

        <x-modal name="create-idea" title="New Idea">
            <form
                x-data="{
                    status: 'pending',
                    newLink: '',
                    links: [],
                    newStep: '',
                    steps: [],
                }"
                method="POST"
                action="{{ route('ideas.store') }}"
                enctype="multipart/form-data"
            >
                @csrf
                <div class="space-y-6">
                    <x-forms.field
                        label="Title"
                        name="title"
                        placeholder="Enter an idea for your title"
                        autofocus
                        required
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
                    />

                    <div class="space-y-2">
                        <label for="image" class="label">Featured Image</label>
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
                    <button type="submit" class="btn" data-test="submit-idea-button">Create</button>
                </div>
            </form>
        </x-modal>
    </div>
</x-layout>
