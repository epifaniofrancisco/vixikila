

<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>
            <!-- <div class="mt-4">
                <x-label for="it_id_militante" :value="__('Militante')" />

                {{-- <x-input id="it_id_militante" class="block mt-1 w-full"
                                type="text"
                                name="it_id_militante" required /> --}}

                <select class="block mt-1 w-full @error('it_id_militante') is-invalid @enderror" name="it_id_militante"
                    required autocomplete="it_id_militante" autofocus>

                    <option value="{{ old('it_id_militante') }}">Selecionar militante</option>
    
                </select>

                @error('it_id_militante')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> -->

            <div class="mt-4">
                <!-- {{-- <div class="form-group "> --}}
                    <x-label for="vc_perfil" :value="__('Perfil')" />
                   {{--  <label for="vc_perfil">{{ __('Perfil') }}</label> --}} -->
                    <select class="block mt-1 w-full" name="vc_perfil" id="vc_perfil" required>

                            <option value="Provincial">Provincial</option>
                            </option>
                            <option value="Municipal">Municipal</option>
                            </option>
                            <option value="Cap">Cap</option>
                            </option>


                    </select>

                {{-- </div> --}}
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>



