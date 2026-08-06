<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('text_brut_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('chief_complaint');
            $table->json('symptoms');
            $table->text('observations');
            $table->string('diagnosis')->nullable();
            $table->date('follow_up_date')->nullable();
            $table->timestamp('validated_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
