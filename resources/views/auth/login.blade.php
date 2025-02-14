<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-900">
                    Connexion
                </h2>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <x-form-input 
                        label="Adresse Email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="email"
                        :error="$errors->first('email')"
                    />
                </div>

                <div class="mb-4">
                    <x-form-input 
                        label="Mot de passe"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        :error="$errors->first('password')"
                    />
                </div>

                <div class="flex items-center justify-between mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-500" href="{{ route('password.request') }}">
                            Mot de passe oublié?
                        </a>
                    @endif
                </div>

                <div class="flex flex-col space-y-4">
                    <x-button type="submit" class="w-full justify-center">
                        Se connecter
                    </x-button>

                    <p class="text-center text-sm text-gray-600">
                        Pas encore de compte?
                        <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            S'inscrire
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>