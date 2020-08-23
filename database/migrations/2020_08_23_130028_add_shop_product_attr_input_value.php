<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShopProductAttrInputValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(SC_DB_PREFIX.'shop_product_attr_input_value', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('attr_id');
            $table->unsignedInteger('product_id');
            $table->string('content_value',255);
            $table->tinyInteger('status');
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
        Schema::dropIfExists(SC_DB_PREFIX.'shop_product_attr_input_value');
    }
}
