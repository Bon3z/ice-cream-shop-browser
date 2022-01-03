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
            $table->foreignId('ice-cream-shop_id');
            $table->string('name');
            $table->string('description');
            $table->string('street_name');
            $table->string('street_number');
            $table->string('unit_number')->nullable();
            $table->string('postal');
            $table->string('x');
            $table->string('y');
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
