<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fact_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fact_id')->index();
            $table->unsignedInteger('tag_id')->nullable()->index();

            $table->foreign('fact_id')->references('id')->on('facts')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fact_tags');
    }
}
