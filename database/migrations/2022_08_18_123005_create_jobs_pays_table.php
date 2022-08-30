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
        Schema::create('jobs_pays', function (Blueprint $table) {
            //$table->id();
            $table->uuid('id')->primary();
            $table->string('job_id')->references('job_id')->on('jobs')
            ->onDelete('cascade');
            $table->string('min_salary')->nullable();
            $table->string('max_salary');
            $table->string('currency');
            $table->string('salary_type');
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
        Schema::dropIfExists('jobs_pays');
    }
};
