<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade');
            $table->foreignId('cours_id')->constrained('cours')->onDelete('cascade');
            $table->enum('statut', ['present', 'absent', 'retard', 'justifie'])->default('absent');
            $table->text('motif')->nullable();
            $table->timestamp('justifie_at')->nullable();
            $table->timestamps();

            $table->unique(['etudiant_id', 'cours_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
