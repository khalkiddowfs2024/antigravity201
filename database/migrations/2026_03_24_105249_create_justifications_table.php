<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('justifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('absence_id')->constrained('absences')->onDelete('cascade');
            $table->string('document_path')->nullable();
            $table->text('commentaire')->nullable();
            $table->foreignId('valide_par')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('valide_at')->nullable();
            $table->enum('statut', ['en_attente', 'approuve', 'rejete'])->default('en_attente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('justifications');
    }
};
