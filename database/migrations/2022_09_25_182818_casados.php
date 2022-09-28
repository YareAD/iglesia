<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'casados',
            function (Blueprint $table) {
                $table->id();
                $table->date('fecha_boda');
                $table->foreignId('id_hombre', 'key_hombre')->constrained('personas', 'id');
                $table->foreignId('id_mujer', 'key_mujer')->constrained('personas', 'id');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('casados');
    }
};
