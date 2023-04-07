<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use App\Models\Piece;
use Illuminate\Http\Request;

class PieceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pieces = Piece::with('fournisseur')->withCount('pointVentes')->latest()->paginate();

        return view('admin.pieces.index',[
            'pieces' => $pieces
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fournisseurs = Fournisseur::all();
        return view('admin.pieces.create',[
            'fournisseurs' => $fournisseurs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1- validation de la requête (formulaire)
        $validated = $request->validate([
            "nom" => 'required|max:255',
            "reference" => 'required|max:255|unique:pieces',
            "quantite" => 'integer|min:0',
            "fournisseur_id" => 'required|exists:fournisseurs,id'
        ]);

        // 2- Créer une nouvelle pièce
        Piece::create($validated);

        // 3- redériger vers la liste des pièces
        return redirect('/admin/pieces');
    }

    /**
     * Display the specified resource.
     */
    public function show(Piece $piece)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Piece $piece)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Piece $piece)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Piece $piece)
    {
        //
    }
}
