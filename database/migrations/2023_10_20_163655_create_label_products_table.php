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
        Schema::create('label_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->index('product_id','product_home_idx');
            $table->foreign('product_id','product_home_fk')->on('products')->references('id')->onDelete('cascade');;

            $table->unsignedBigInteger('homeLabel_id');
            $table->index('homeLabel_id','homeCategory_home_idx');
            $table->foreign('homeLabel_id','homeCategory_home_fk')->on('home_product_labels')->references('id')->onDelete('cascade');;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('label_products');
    }
};
