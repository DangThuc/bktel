<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinhviensTable extends Migration
{
    /**
     * Run the migrations.
     *
     *
     */
    public function up():void
    {
        Schema::create('sinhviens', function (Blueprint $table) {
            $table->id();
            $table->string('Firstname');
            $table->string('Lastname');
            $table->string('Studentcode');
            $table->string('Department');
            $table->string('Faculty');
            $table->string('Address');
            $table->string('Phone');
            $table->string('Note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     *
     */
    public function down():void
    {
        Schema::dropIfExists('sinhviens');
    }
}
