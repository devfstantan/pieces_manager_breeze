<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouveau Fournisseur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="relative overflow-x-auto">
                        <form action="{{ route('admin.fournisseurs.store') }}" method="POST">
                            @csrf
                            {{-- Nom --}}
                            <div class="mt-4">
                                <x-input-label for="nom" :value="__('Nom')" />
                    
                                <x-text-input id="nom" class="block mt-1 w-full"
                                                type="text"
                                                name="nom"
                                                value="{{old('nom')}}"
                                                required  />
                    
                                <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                            </div>
                            {{-- Adresse --}}
                            <div class="mt-4">
                                <x-input-label for="adresse" :value="__('Adresse')" />
                    
                                <x-text-input id="adresse" class="block mt-1 w-full"
                                                type="text"
                                                name="adresse"
                                                value="{{old('adresse')}}"
                                                required  />
                    
                                <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
                            </div>
                            
                            
                            <x-primary-button class="mt-3">
                                {{ __('Ajouter') }}
                            </x-primary-button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>