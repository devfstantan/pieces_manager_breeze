@extends('layouts.app');
@section('content')
    <h1>Nouveau Point de Vente</h1>

    <form action="{{ route('point_ventes.store') }}" method="POST">
        @csrf

        <div>
            <label for="nom">Nom</label> <br>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}">
            @error('nom')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="nom_gerant">Nom du gérant</label> <br>
            <input type="text" id="nom_gerant" name="nom_gerant" value="{{ old('nom_gerant') }}">
            @error('nom_gerant')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="adresse">Adresse</label> <br>
            <input type="text" id="adresse" name="adresse" value="{{ old('adresse') }}">
            @error('adresse')
                <p>{{ $message }}</p>
            @enderror
        </div>
        
        <input type="submit" value="Ajouter">
    </form>
@endsection
