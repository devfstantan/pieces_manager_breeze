<x-vendeur-layout>
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
                                    <th scope="col" class="px-6 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nom
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Adresse
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($fournisseurs as $fournisseur)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">{{ $fournisseur->id }}</td>
                                        <td class="px-6 py-4">{{ $fournisseur->nom }}</td>
                                        <td class="px-6 py-4">{{ $fournisseur->adresse }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>{{ __('Aucun Fournisseur Trouvé') }}</td>
                                    </tr>
                                @endforelse


                            </tbody>
                        </table>
                    </div>

                    {{ $fournisseurs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-vendeur-layout>
