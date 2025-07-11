<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->foreignId('news_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable();
            // $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name')->nullable();  // For guest comments
            $table->string('email')->nullable(); // For guest comments
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
        Schema::dropIfExists('comments');
    }
}
