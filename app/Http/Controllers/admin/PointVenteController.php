<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointVente;
use Illuminate\Http\Request;

class PointVenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pointVentes = PointVente::withCount('pieces')->latest()->paginate();

        return view('admin.point_ventes.index',[
            'pointVentes' => $pointVentes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.point_ventes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        // 1- validation de la requête (formulaire)
        $validated = $request->validate([
            "nom" => 'required|max:255',
            "nom_gerant" => 'required|max:255',
            "adresse" => 'required|max:255',
        ]);

        // 2- Créer une nouveau Point de vente
        PointVente::create($validated);

        // 3- redériger vers la liste des points de ventes
        return redirect('/admin/point_ventes');
    }

    /**
     * Display the specified resource.
     */
    public function show(PointVente $pointVente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PointVente $pointVente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PointVente $pointVente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PointVente $pointVente)
    {
        //
    }
}
