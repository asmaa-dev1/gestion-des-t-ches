<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-900">
                    Créer un compte
                </h2>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <x-form-input 
                        label="Nom"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name"
                        :error="$errors->first('name')"
                    />
                </div>

                <div class="mb-4">
                    <x-form-input 
                        label="Adresse Email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
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
                        autocomplete="new-password"
                        :error="$errors->first('password')"
                    />
                </div>

                <div class="mb-4">
                    <x-form-input 
                        label="Confirmer le mot de passe"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                </div>

                <div class="flex flex-col space-y-4">
                    <x-button type="submit" class="w-full justify-center">
                        S'inscrire
                    </x-button>

                    <p class="text-center text-sm text-gray-600">
                        Déjà inscrit?
                        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Se connecter
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>