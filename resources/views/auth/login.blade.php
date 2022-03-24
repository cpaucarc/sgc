<x-guest-layout>
    <x-jet-authentication-card>

        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo/>--}}
            <div class="grid place-items-center">
                <img class="w-14 mb-2" src="{{ asset('images/unasam/escudo_oficial.webp') }}"
                     alt="Escudo de la Unasam">
                <h1 class="text-gray-700 text-xl font-thin">Iniciar Sesión</h1>
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
                    {{ __('Iniciar Sesión') }}
                    <svg class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                              clip-rule="evenodd"/>
                    </svg>
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
