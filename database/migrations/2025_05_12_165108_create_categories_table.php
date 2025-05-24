<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mask');
            $table->integer('status')->nullable()->default(0);
            $table->timestamps();
        });

        DB::table('categories')->insert([
            'name' => 'Public Relations',
            'mask' => Str::slug('Public Relations'),
            'status'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        DB::table('categories')->insert([
            'name' => '⁠Story telling',
            'mask' => Str::slug('⁠Story telling'),
            'status'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('categories')->insert([
            'name' => '⁠⁠Globe trotter',
            'mask' => Str::slug('Globe trotter'),
            'status'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('categories')->insert([
            'name' => '⁠⁠Learn A Language',
            'mask' => Str::slug('⁠Learn A Language'),
            'status'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('categories')->insert([
            'name' => '⁠⁠⁠Trends & Insight',
            'mask' => Str::slug('⁠⁠⁠Trends & Insight'),
            'status'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('categories')->insert([
            'name' => '⁠⁠⁠⁠Voix Global Communications',
            'mask' => Str::slug('⁠⁠⁠⁠Voix Global Communications'),
            'status'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('categories')->insert([
            'name' => '⁠⁠⁠⁠⁠Others',
            'mask' => Str::slug('⁠⁠⁠⁠⁠Others'),
            'status'=> 1,
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
        Schema::dropIfExists('categories');
    }
}
