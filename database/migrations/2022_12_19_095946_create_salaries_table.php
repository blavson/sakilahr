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
        Schema::create('salaries', function (Blueprint $table) {
            $table->unsignedInteger('employee_id');
            $table->integer('salary');
            $table->date('from_date');
            $table->date('to_date');
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->primary(['employee_id', 'from_date']);
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
        Schema::dropIfExists('salaries');
    }
};
