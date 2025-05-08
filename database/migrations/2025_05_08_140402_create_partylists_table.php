<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('partylists', function (Blueprint $table) {
            $table->id();     
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');       
            $table->string('partylistname');
            $table->string('shortname');
            $table->string('contact');
            $table->string('platform');
            $table->date('date');
            $table->string('status');          
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partylists');
    }
};
