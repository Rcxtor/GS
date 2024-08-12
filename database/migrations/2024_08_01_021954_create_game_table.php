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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('descrip');
            $table->decimal('price', 8, 2);
            $table->decimal('rating', 3, 1);
            $table->decimal('quantity',8, 0)->default(0); //
            $table->decimal('total_sale', 8, 0)->default(0); //
            $table->string('platform');
            $table->date('release');
            $table->string('trailer')->nullable();
            $table->string('dev')->nullable(); //
            $table->string('publisher')->nullable(); //
            $table->string('cover')->nullable(); //
            $table->text('photo')->nullable();
            $table->string('extra')->nullable();//
            $table->string('genre')->nullable();//
            $table->boolean('featured')->default(false);
            $table->boolean('on_sale')->default(false);
            $table->date('sale_date')->nullable();//; //
            $table->decimal('sale_per', 8, 1)->nullable();//; //
            $table->boolean('top_sale')->default(false);
            $table->boolean('coming_soon')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
