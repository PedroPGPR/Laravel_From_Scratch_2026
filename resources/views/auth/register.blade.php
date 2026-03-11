<x-layout>
    <x-forms.form title="Register Now" description="Create your account to get started.">
        <form action="/register" method="POST" class="mt-8 space-y-6">
            @csrf

            <x-forms.field label="Name" name="name"/>
            <x-forms.field label="Email" name="email" type="email"/>
            <x-forms.field label="Password" name="password" type="password"/>

            <button type="submit" id="register-button" class="btn w-full mt-2 h-10">
                Register
            </button>
        </form>
    </x-forms.form>
</x-layout>
