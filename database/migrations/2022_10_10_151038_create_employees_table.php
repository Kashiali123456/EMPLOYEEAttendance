<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('contact_no', 12);
            $table->string('designation', 150);
            $table->string('profile', 150);
            $table->string('department', 150);
            $table->string('job_type', 150);
            $table->string('email', 150);
            $table->string('password', 150);
            $table->string('joining_date', 150);
            $table->string('status', 20);
            $table->json('attendance');
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
        Schema::dropIfExists('employees');
    }
};
