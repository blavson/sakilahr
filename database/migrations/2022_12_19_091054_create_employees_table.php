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

        Schema::create('roles', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->unsignedInteger('employee_id')->from(10000)->autoIncrement();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender', 1);
            $table->date('birth_date');
            $table->string('email')->unique();
            $table->unsignedInteger('role_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('password');
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
