<x-layout>
    <form action="/register" method="POST">
        @csrf
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 mx-auto">
            <legend class="fieldset-legend">Register</legend>

            <label class="label" for="name">Name</label>
            <input type="text" id="name" name="name" class="input" placeholder="Your name" required />

            <label class="label" for="email">Email</label>
            <input type="email" id="email" name="email" class="input" placeholder="Your email" required />

            <label class="label" for="password">Password</label>
            <input type="password" id="password" name="password" class="input" placeholder="Your password" required />

            <button class="btn btn-neutral mt-4" data-testid="register-button">Register</button>
        </fieldset>
    </form>
</x-layout>
