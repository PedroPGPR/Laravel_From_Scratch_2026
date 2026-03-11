<x-layout>
    <x-forms.form title="Sign In" description="Enter your credentials to access your account.">
        <form action="/login" method="POST" class="mt-8 space-y-6">
            @csrf

            <x-forms.field label="Email" name="email" type="email" required/>
            <x-forms.field label="Password" name="password" type="password" required/>

            <button type="submit" id="login-button" class="btn w-full mt-2 h-10">
                Sign In
            </button>
        </form>
    </x-forms.form>
</x-layout>
