<a {{ $attributes->merge(['class' => 'card bg-neutral-800 text-neutral-content w-96 hover:bg-neutral-900']) }}>
    <div class="card-body">
        <h2 class="card-title">{{ $slot }}</h2>
    </div>
</a>
