<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fournisseur extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "nom",
        "adresse",
    ];
    public function pieces():HasMany
    {
        return $this->hasMany(Piece::class);
    }
}
