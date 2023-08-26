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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->float('amount');
            $table->date('spent_at');
            $table->longText('info');
            $table->foreignId('category_id')->constrained('categories', 'id');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->timestamps();
            $table->index(['user_id', 'category_id']);
            $table->index(['user_id', 'spent_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
