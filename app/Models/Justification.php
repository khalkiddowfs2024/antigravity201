<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Justification extends Model
{
    use HasFactory;

    protected $fillable = ['absence_id', 'document_path', 'commentaire', 'valide_par', 'valide_at', 'statut'];

    protected $casts = [
        'valide_at' => 'datetime',
    ];

    public function absence()
    {
        return $this->belongsTo(Absence::class);
    }

    public function validateur()
    {
        return $this->belongsTo(User::class, 'valide_par');
    }
}
