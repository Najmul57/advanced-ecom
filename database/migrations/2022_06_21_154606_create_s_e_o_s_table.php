<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSEOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_e_o_s', function (Blueprint $table) {
            $table->id();
            $table->string('meta_title')->nullable();
            $table->string('meta_author')->nullable();
            $table->string('meta_tag')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('google_verification')->nullable();
            $table->string('google_analytics')->nullable();
            $table->string('alexa_verification')->nullable();
            $table->string('google_adsense')->nullable();
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
        Schema::dropIfExists('s_e_o_s');
    }
}