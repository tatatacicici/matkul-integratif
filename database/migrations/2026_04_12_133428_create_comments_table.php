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
       Schema::create('comments', function (Blueprint $table) {
        $table->id();
        // varchar dengan panjang maksimal 250 karakter sesuai buku
        $table->string('comment', 250); 
        
        // Foreign key ke tabel posts (kalau post dihapus, comment ikut terhapus)
        $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
        
        // Foreign key ke tabel users
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
