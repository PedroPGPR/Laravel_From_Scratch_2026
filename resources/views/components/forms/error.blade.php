@props([
    'name' => 'required',
])

@error($name)
    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
@enderror
