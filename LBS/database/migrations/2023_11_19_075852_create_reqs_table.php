<?php

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
        Schema::create('reqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id');
            $table->foreignId('user_id');
            $table->string('image')->nullable();
            $table->string('addres');
            $table->string('slug')->unique();
            $table->text('information');
            $table->enum('status',['belum dibersihkan','sudah dibersihkan']);
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamp('publish_at');
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
        Schema::dropIfExists('reqs');
    }
};
