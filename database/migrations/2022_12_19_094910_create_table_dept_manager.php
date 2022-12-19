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
        Schema::create('dept_manager', function (Blueprint $table) {
            $table->unsignedInteger('employee_id');
            $table->unsignedInteger('department_id');
            $table->date('from_date');
            $table->date('to_date');
            $table->foreign('employee_id')->references('employee_id')->on('employees');
            $table->foreign('department_id')->references('department_id')->on('departments');
            $table->primary(['employee_id', 'department_id']);

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
        Schema::dropIfExists('table_dept_manager');
    }
};
