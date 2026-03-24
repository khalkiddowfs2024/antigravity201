<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'niveau', 'annee_scolaire'];

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function cours()
    {
        return $this->hasMany(Cours::class);
    }
}
