<x-layout>
    <form action="/login" method="POST">
        @csrf
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 mx-auto">
            <legend class="fieldset-legend">Log In</legend>

            <label class="label" for="email">Email</label>
            <input type="email" id="email" name="email" class="input" placeholder="Your email" required />

            <label class="label" for="password">Password</label>
            <input type="password" id="password" name="password" class="input" placeholder="Your password" required />

            <x-forms.error name="email" />

            <button class="btn btn-neutral mt-4">Log In</button>
        </fieldset>
    </form>
</x-layout>
