<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('category_id')->nullable();
            $table->text('summary')->nullable();
            $table->text('introduction')->nullable();
            $table->string('image')->nullable();
            $table->string('image_filename')->nullable();
            $table->date('added_on')->nullable();
            $table->date('date')->nullable();
            $table->string('status')->nullable();
            $table->string('mask')->nullable();
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
        Schema::dropIfExists('news');
    }
}
