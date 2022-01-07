<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIceCreamShopPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ice_cream_shop_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ice_cream_shop_id');
            $table->foreign('ice_cream_shop_id')
                ->references('id')
                ->on('ice_cream_shops')
                ->onDelete('cascade');
            $table->string('path');
            $table->string('name');
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
        Schema::dropIfExists('ice_cream_shop_photos');
    }
}
