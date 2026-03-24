<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'classe_id', 'numero_matricule', 'date_naissance'];

    protected $casts = [
        'date_naissance' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    // Absences non justifiées
    public function absencesNonJustifiees()
    {
        return $this->hasMany(Absence::class)->where('statut', 'absent');
    }
}
