<x-guest-layout>
    <x-jet-authentication-card>

        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo/>--}}
            <div class="grid place-items-center">
                <img class="w-16" src="{{ asset('images/unasam_escudo.svg') }}" alt="Escudo de la Unasam">
                <h1 class="text-gray-800 text-xl font-thin mt-1">Iniciar sesión en SGC FCM</h1>
            </div>
        </x-slot>

        <x-jet-validation-errors class="mb-4"/>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div class="space-y-4">
                <div>
                    <x-jet-label for="email" value="{{ __('Email') }}"/>
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                                 required autofocus/>
                </div>

                <div>
                    <x-jet-label for="password" value="{{ __('Password') }}"/>
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                 autocomplete="current-password"/>
                </div>

                <div>
                    <label for="remember_me" class="flex items-center">
                        <x-jet-checkbox id="remember_me" name="remember"/>
                        <span class="ml-2 text-sm text-gray-600">Recordar sesión</span>
                    </label>
                </div>
            </div>

            <div>
                <x-jet-button class="justify-center text-center w-full">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
