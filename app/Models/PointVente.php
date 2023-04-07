<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointVente extends Model
{
    use HasFactory;

    protected $fillable = [
        "nom",
        "nom_gerant",
        "adresse",
    ];

    public function pieces(){
        return $this->belongsToMany(Piece::class);
    }
}
