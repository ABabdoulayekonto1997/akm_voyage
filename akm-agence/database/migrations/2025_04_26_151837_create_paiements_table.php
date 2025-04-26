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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservation_id');
            $table->decimal('montant', 10, 2);
            $table->enum('methode', ['Stripe', 'PayPal', 'MobileMoney']);
            $table->enum('statut', ['effectue', 'echoue', 'en_attente'])->default('en_attente');
            $table->timestamp('date_paiement')->useCurrent();
            
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
