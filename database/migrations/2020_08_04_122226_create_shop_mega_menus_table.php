<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopMegaMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(SC_DB_PREFIX.'shop_mega_menus', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->unsigned()->default(0);
            $table->integer('sort')->unsigned()->default(0);
            $table->string('title',155);
            $table->string('icon',155)->nullable();
            $table->string('url',255);
            $table->integer('type')->default(0);
            $table->integer('block')->unsigned()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(SC_DB_PREFIX.'shop_mega_menus');
    }
}
