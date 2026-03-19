<x-layout>
    <x-forms.form title="Edit your account" description="Need to make a tweak to your account? Update your information here.">
        <form action="{{ route('profile.update') }}" method="POST" class="mt-8 space-y-6">
            @csrf
            @method('PATCH')

            <x-forms.field label="Name" name="name" value="{{ $user->name }}" />
            <x-forms.field label="Email" name="email" type="email" value="{{ $user->email }}" />
            <x-forms.field label="New Password" name="password" type="password" />

            <button type="submit" id="register-button" class="btn w-full mt-2 h-10">
                Update Account
            </button>
        </form>
    </x-forms.form>
</x-layout>
