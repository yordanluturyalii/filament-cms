<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <x-mary-form wire:submit.prevent="login" method='POST' action="{{ route('login') }}">
            @csrf
            <div class="w-full">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input name="email" label="Email" type="email" placeholder="Email" required class="w-full"/>
            </div>
            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input name="password" label="Password" type="password" placeholder="Password" required class="w-full"/>
            </div>
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox name="remember_me" id="remember_me" checked />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded focus:outline" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex mt-4">
                <x-slot:actions>
                    <x-mary-button type="submit" class="w-full btn-primary">
                        {{ __('Login') }}
                    </x-mary-button>
                </x-slot:actions>
            </div>

        </x-mary-form>

        <div class="relative mt-5">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-sm font-medium leading-6">
                <span class="bg-white px-6 text-gray-900">or Continue with</span>
            </div>
        </div>
        <div class="w-full mt-3">
            <a href="{{route('auth.redirect', 'twitter')}}" class="w-full" wire:navigate>
                <x-mary-button label="Twitter" class="w-full btn-ghost text-blue-500" icon="fab.twitter" />
            </a>
        </div>

    </x-authentication-card>
</x-guest-layout>
