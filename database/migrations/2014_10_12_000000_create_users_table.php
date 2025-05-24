<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('telephone_number')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('status')->nullable()->defualt(1);
            $table->string('password');
            $table->dateTime('last_login')->nullable();
            $table->string('mask');
            $table->timestamps();
            $table->softDeletes();
        });



        DB::table('users')->insert([
            'first_name' => 'Eduplatform',
            'last_name' => 'Administrator',
            'email' => 'admin@prissysvoice.com',
            'mask' => \generate_mask(),
            'status'=> 1,
            'password' => Hash::make('Blog@2025!!..'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
