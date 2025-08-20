<x-guest-layout>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
    </div>
    @endif

    <div class="mt-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-button
                    class="bg-base-blue-400 opacity-95 hover:opacity-100 w-full text-base transition font-poppins">
                    {{ __('Resend Verification Email') }}
                </x-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-button class="bg-base-blue-400 opacity-95 hover:opacity-100 w-full text-base transition font-poppins">
                {{ __('Log Out') }}
            </x-button>
        </form>
    </div>
</x-guest-layout>
