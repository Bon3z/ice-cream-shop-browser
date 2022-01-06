<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllergensTable extends Migration
{
    public function up()
    {
        Schema::create('allergens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ingredient_id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('allergens');
    }
}
