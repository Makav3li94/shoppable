<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(SC_DB_PREFIX.'shop_ad_description', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ad_id');
            $table->string('lang', 10)->index();
            $table->string('image', 255)->nullable();
            $table->text('body')->nullable();
            $table->timestamps();
            $table->foreign('ad_id')->references('id')->on(SC_DB_PREFIX.'shop_ads')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(SC_DB_PREFIX.'shop_ad_description');
    }
}
