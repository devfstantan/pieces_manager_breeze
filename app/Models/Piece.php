<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    use HasFactory;

    protected $fillable = [
        "nom",
        "reference",
        "quantite",
        "fournisseur_id"
    ];

    public function fournisseur(){
        return $this->belongsTo(Fournisseur::class);
    }

    public function pointVentes(){
        return $this->belongsToMany(PointVente::class);
    }
}
