<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIceCreamShopProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ice_cream_shop_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ice_cream_shop_id');
            $table->foreign('ice_cream_shop_id')
                ->references('id')
                ->on('ice_cream_shops')
                ->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('description')->nullable();
            $table->string('street_name')->nullable();
            $table->string('street_number')->nullable();
            $table->string('unit_number')->nullable();
            $table->string('postal')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
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
        Schema::dropIfExists('ice_cream_shop_profiles');
    }
}
