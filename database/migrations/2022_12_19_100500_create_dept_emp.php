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
        Schema::create('dept_emp', function (Blueprint $table) {
            $table->unsignedInteger('employee_id');
            $table->unsignedInteger('department_id');
            $table->Date('from_date');
            $table->Date('to_date');
            $table->foreign('employee_id')->references('employee_id')->on('employees');
            $table->foreign('department_id')->references('department_id')->on('departments');
            $table->timestamps();
            $table->primary(['employee_id', 'department_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dept_emp');
    }
};
