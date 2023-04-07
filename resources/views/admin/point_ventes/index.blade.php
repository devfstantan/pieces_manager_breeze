@extends('layouts.app');
@section('content')
    <h1>Liste des Points de VEntes</h1>

    <a href="{{route('point_ventes.create')}}">Nouveau Point de Vente</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Nb Pièces</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pointVentes as $pointVente)
                <tr>
                    <td>{{$pointVente->id}}</td>
                    <td>{{$pointVente->nom}}</td>
                    <td>{{$pointVente->adresse}}</td>
                    <td>{{$pointVente->pieces_count}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Aucun Point de Vente trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection