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
        Schema::dropIfExists('posts'); // Drop the posts table if it exists
        Schema::dropIfExists('companies'); // Drop the companies table if it exists
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
