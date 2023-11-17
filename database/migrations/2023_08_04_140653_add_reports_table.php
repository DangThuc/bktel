<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportsTable extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sinhvien_id')->bigInterger()->constrained('sinhviens')->onDelete('cascade');
            $table->foreignId('teacher_to_subjects_id')->bigInterger()->constrained('teacher_to_subjects')->onDelete('cascade');
            $table->string('title');
            $table->string('path');
            $table->float('mark', 8,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
}
