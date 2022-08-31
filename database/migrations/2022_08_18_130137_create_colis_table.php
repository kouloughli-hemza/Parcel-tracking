<?php

use Dsone\Support\Enum\SendTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colis', function (Blueprint $table) {
            $table->id();
            $table->string('description_produit')->nullable();
            $table->string('poids')->nullable();
            $table->decimal('prix_unitaire',25,2)->default(0);
            $table->string('tracking_number');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('facture_id')->constrained()->onDelete('cascade');
            $table->foreignId('expediteur_id')->constrained()->onDelete('cascade');
            $table->enum('shipping_type', SendTypes::lists())
                ->default(SendTypes::DOMICILE);
            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colis');
    }
}
