<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Fournisseurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="relative overflow-x-auto">
                        

                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th></th>
                                    <th scope="col" class="px-6 py-3">{{ __('ID')}}</th>
                                    <th scope="col" class="px-6 py-3"> {{ __('Nom')}}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('Nombre Pièces')}}</th>
                                    <th scope="col" class="px-6 py-3" colspan="2">
                                        <x-primary-button-link :href="route('admin.fournisseurs.create')" > {{ __('Nouveau Fournisseur') }} </x-primary-button-link>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($fournisseurs as $fournisseur)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            <x-fournisseur-logo-image :src="$fournisseur->logo" />
                                        </td>
                                        <td class="px-6 py-4">{{ $fournisseur->id }}</td>
                                        <td class="px-6 py-4">{{ $fournisseur->nom }}</td>
                                        <td class="px-6 py-4">{{ $fournisseur->pieces_count }}</td>
                                        <td class="px-6 py-4">
                                            <x-secondary-button-link :href="route('admin.fournisseurs.edit',$fournisseur)" > {{ __('Editer') }} </x-secondary-button-link>
                                        </td>
                                        <td class="px-6 py-4">
                                            <x-destroy-button :action="route('admin.fournisseurs.destroy',$fournisseur)" />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>{{ __('Aucun Fournisseur Trouvé') }}</td>
                                    </tr>
                                @endforelse


                            </tbody>
                        </table>
                        {{ $fournisseurs->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
