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
        Schema::create('parent', function (Blueprint $table) {
            $table->id();
            $table->string('parent_type');
            $table->string('parent_name');
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->unsignedBigInteger('municipal_id')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('profile_id');

            $table->foreign('profile_id')->references('id')->on('profile')->onDelete('cascade');
            $table->foreign('barangay_id')->references('id')->on('barangay')->onDelete('set null');
            $table->foreign('municipal_id')->references('id')->on('municipal')->onDelete('set null');
            $table->foreign('province_id')->references('id')->on('province')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent');
    }
};
