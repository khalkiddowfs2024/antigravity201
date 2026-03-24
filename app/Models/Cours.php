<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cours extends Model
{
    use HasFactory;

    protected $fillable = ['classe_id', 'matiere_id', 'enseignant_id', 'date', 'heure_debut', 'heure_fin'];

    protected $casts = [
        'date' => 'date',
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function enseignant()
    {
        return $this->belongsTo(User::class, 'enseignant_id');
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }
}
