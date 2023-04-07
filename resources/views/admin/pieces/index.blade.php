@extends('layouts.app');
@section('content')
    <h1>Liste des Pièces</h1>
    <a href="{{route('pieces.create')}}"> Nouvelle Pièce</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Référence</th>
                <th>Quantité</th>
                <th>Nom du Fournisseur</th>
                <th>Nb Points de Ventes</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pieces as $piece)
                <tr>
                    <td>{{$piece->id}}</td>
                    <td>{{$piece->nom}}</td>
                    <td>{{$piece->reference}}</td>
                    <td>{{$piece->quantite}}</td>
                    <td>{{$piece->fournisseur->nom}}</td>
                    <td>{{$piece->point_ventes_count}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Aucune Pièces trouvée</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des Pièces<') }}
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
                                    <th scope="col" class="px-6 py-3" >ID</th>
                                    <th scope="col" class="px-6 py-3" >Nom</th>
                                    <th scope="col" class="px-6 py-3" >Référence</th>
                                    <th scope="col" class="px-6 py-3" >Quantité</th>
                                    <th scope="col" class="px-6 py-3" >Nom du Fournisseur</th>
                                    <th scope="col" class="px-6 py-3" >Nb Points de Ventes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pieces as $piece)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4" >{{$piece->id}}</td>
                                        <td class="px-6 py-4" >{{$piece->nom}}</td>
                                        <td class="px-6 py-4" >{{$piece->reference}}</td>
                                        <td class="px-6 py-4" >{{$piece->quantite}}</td>
                                        <td class="px-6 py-4" >{{$piece->fournisseur->nom}}</td>
                                        <td class="px-6 py-4" >{{$piece->point_ventes_count}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>{{ __('Aucune Pièces trouvée') }}</td>
                                    </tr>
                                @endforelse


                            </tbody>
                        </table>
                        {{ $pieces->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>