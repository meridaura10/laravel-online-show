<?php

use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_values', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Option::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('option_value_product', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OptionValue::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('option_value_product');
        Schema::dropIfExists('option_values');
    }
};
