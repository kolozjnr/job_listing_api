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
        Schema::create('jobs', function (Blueprint $table) {
            //$table->id();
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users')
            ->onDelete('cascade');
            $table->string('job_id');
            $table->string('job_title');
            $table->string('company_name');
            $table->string('Application_type');
            $table->string('tags');
            $table->string('sector');
            $table->date('application_deadline');
            $table->string('apply_email');
            $table->boolean('is_urgent');
            $table->string('company_logo');
            $table->boolean('is_filled')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('jobs');
    }
};
