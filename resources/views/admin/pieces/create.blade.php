@extends('layouts.app');
@section('content')
    <h1>Nouvelle Pièce</h1>

    <form action="{{ route('pieces.store') }}" method="POST">
        @csrf

        <div>
            <label for="nom">Nom</label> <br>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}">
            @error('nom')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="reference">Référence</label> <br>
            <input type="text" id="reference" name="reference" value="{{ old('reference') }}">
            @error('reference')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="quantite">Quantité</label> <br>
            <input type="number" min="0" id="quantite" name="quantite" value="{{ old('quantite') }}">
            @error('quantite')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="fournisseur_id">Fournisseur</label> <br>
            <select name="fournisseur_id" id="fournisseur_id">
                <option value="">Choisir un fournisseur</option>
                @foreach ($fournisseurs as $fournisseur)
                    <option value="{{ $fournisseur->id }}" @selected(old('fournisseur_id') == $fournisseur->id)>{{ $fournisseur->nom }}</option>
                @endforeach
            </select>
            @error('fournisseur_id')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <input type="submit" value="Ajouter">
    </form>
@endsection
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouvelle Pièce') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="relative overflow-x-auto">

                        <form action="{{ route('admin.pieces.store') }}" method="POST">
                            @csrf

                            <div>
                                <label for="nom">Nom</label> <br>
                                <input type="text" id="nom" name="nom" value="{{ old('nom') }}">
                                @error('nom')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="reference">Référence</label> <br>
                                <input type="text" id="reference" name="reference" value="{{ old('reference') }}">
                                @error('reference')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="quantite">Quantité</label> <br>
                                <input type="number" min="0" id="quantite" name="quantite"
                                    value="{{ old('quantite') }}">
                                @error('quantite')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="fournisseur_id">Fournisseur</label> <br>
                                <select name="fournisseur_id" id="fournisseur_id">
                                    <option value="">Choisir un fournisseur</option>
                                    @foreach ($fournisseurs as $fournisseur)
                                        <option value="{{ $fournisseur->id }}" @selected(old('fournisseur_id') == $fournisseur->id)>
                                            {{ $fournisseur->nom }}</option>
                                    @endforeach
                                </select>
                                @error('fournisseur_id')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>
                            <input type="submit" value="Ajouter">
                        </form>
                    </div>

                    {{ $fournisseurs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
