<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorruptionRotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corruption_rotations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('corruption_id');
            $table->unsignedBigInteger('rotation_id');
            $table->foreign('corruption_id')->references('id')->on('corruptions')->onDelete('cascade');
            $table->foreign('rotation_id')->references('id')->on('rotations')->onDelete('cascade');
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
        Schema::dropIfExists('corruption_rotations');
    }
}
