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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();

            $table->string('prod_nome')->nullable();
            $table->string('prod_descricao')->nullable();
            $table->string('prod_categoria')->nullable();
            $table->integer('prod_quantidade')->nullable();
            $table->float('prod_preco')->nullable();
            $table->string('prod_foto')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
