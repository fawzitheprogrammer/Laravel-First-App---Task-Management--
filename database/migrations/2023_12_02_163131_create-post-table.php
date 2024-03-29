<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::create('posts',function(Blueprint $table){
        $table->id();
        $table->timestamps();
        $table->string('title');
        $table->longtext('body');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
