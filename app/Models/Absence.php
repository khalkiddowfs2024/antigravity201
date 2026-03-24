<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = ['etudiant_id', 'cours_id', 'statut', 'motif', 'justifie_at'];

    protected $casts = [
        'justifie_at' => 'datetime',
        
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }

    public function justification()
    {
        return $this->hasOne(Justification::class);
    }
}
