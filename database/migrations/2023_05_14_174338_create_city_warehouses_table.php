<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('city_ref');
            $table->foreign('city_ref')->references('ref')
                ->on('cities')
                ->onDelete('cascade');
            $table->string('address');
            $table->integer('number');
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
        Schema::dropIfExists('city_warehouses');
    }
};
