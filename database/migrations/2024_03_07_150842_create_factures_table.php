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
        Schema::create('factures', function (Blueprint $table) {
            $table->string('reference', 9)->primary();
            $table->string('index_precedant', 4)->default('')->change();
            $table->string('index_suivant', 4)->default('')->change();
            $table->dateTimeTz('date_payment')->nullable();
            $table->date('date_limite_p');
            $table->enum('type_facture', ['eau', 'gaz', 'electricité']);
            $table->double('montant', 10, 0); 
            $table->unsignedBigInteger('compteur_id');
            $table->foreign('compteur_id')->references('id')->on('compteurs'); 
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
