<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdeasTable extends Migration
{
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('battle_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('points')->default(0); // cached votes count
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ideas');
    }
}