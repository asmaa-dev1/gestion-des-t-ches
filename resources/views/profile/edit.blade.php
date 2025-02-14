<x-app-layout>
    @section('header')
        Mon Profil
    @endsection

    @section('content')
    <div class="space-y-6">
        <x-card>
            <x-slot name="header">
                <h2 class="text-lg font-medium text-gray-900">
                    Informations du Profil
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Mettez à jour vos informations de compte.
                </p>
            </x-slot>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div>
                    <x-form-input 
                        label="Nom"
                        type="text"
                        name="name"
                        :value="old('name', $user->name)"
                        required
                        autofocus
                        autocomplete="name"
                        :error="$errors->first('name')"
                    />
                </div>

                <div>
                    <x-form-input 
                        label="Email"
                        type="email"
                        name="email"
                        :value="old('email', $user->email)"
                        required
                        autocomplete="email"
                        :error="$errors->first('email')"
                    />
                </div>

                <div class="flex items-center gap-4">
                    <x-button>
                        Sauvegarder
                    </x-button>
                </div>
            </form>
        </x-card>

        <x-card>
            <x-slot name="header">
                <h2 class="text-lg font-medium text-gray-900">
                    Modifier le mot de passe
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Assurez-vous d'utiliser un mot de passe long et sécurisé.
                </p>
            </x-slot>

            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div>
                    <x-form-input 
                        label="Mot de passe actuel"
                        type="password"
                        name="current_password"
                        autocomplete="current-password"
                        :error="$errors->first('current_password')"
                    />
                </div>

                <div>
                    <x-form-input 
                        label="Nouveau mot de passe"
                        type="password"
                        name="password"
                        autocomplete="new-password"
                        :error="$errors->first('password')"
                    />
                </div>

                <div>
                    <x-form-input 
                        label="Confirmer le mot de passe"
                        type="password"
                        name="password_confirmation"
                        autocomplete="new-password"
                    />
                </div>

                <div class="flex items-center gap-4">
                    <x-button>
                        Sauvegarder
                    </x-button>
                </div>
            </form>
        </x-card>

        <x-card>
            <x-slot name="header">
                <h2 class="text-lg font-medium text-red-600">
                    Supprimer le compte
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Une fois votre compte supprimé, toutes vos ressources et données seront définitivement effacées.
                </p>
            </x-slot>

            <div class="flex justify-start">
                <x-button
                    variant="danger"
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                >
                    Supprimer le compte
                </x-button>
            </div>
        </x-card>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                Êtes-vous sûr de vouloir supprimer votre compte ?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Une fois votre compte supprimé, toutes vos ressources et données seront définitivement effacées.
            </p>

            <div class="mt-6">
                <x-form-input
                    label="Mot de passe"
                    type="password"
                    name="password"
                    placeholder="Mot de passe"
                    :error="$errors->userDeletion->first('password')"
                />
            </div>

            <div class="mt-6 flex justify-end">
                <x-button variant="secondary" x-on:click="$dispatch('close')">
                    Annuler
                </x-button>

                <x-button variant="danger" class="ml-3">
                    Supprimer le compte
                </x-button>
            </div>
        </form>
    </x-modal>
    @endsection
</x-app-layout>