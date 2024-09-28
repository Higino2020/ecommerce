<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->integer('qtd')->default(0);
            $table->foreignId('funcionario')->constrained('users')->onDelete('no action');
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('no action');
            $table->foreignId('produto_id')->constrained('produtos')->onDelete('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
