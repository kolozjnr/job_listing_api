<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_requirements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('job_id')->references('job_id')->on('jobs')
            ->onDelete('cascade');
            $table->string('role');
            $table->string('experience');
            $table->string('qualification');
            $table->string('gender');
            $table->string('career_level')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs_requirements');
    }
};
