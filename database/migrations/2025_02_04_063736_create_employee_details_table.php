<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_details', function (Blueprint $table) {
            $table->id('emp_id');
            $table->string('emp_name', 100);
            $table->string('emp_email', 150)->unique();
            $table->string('emp_phone', 15)->unique();
            $table->string('emp_address', 250)->nullable();
            $table->string('emp_designation', 100);
            $table->string('emp_department', 100);
            $table->date('emp_joining_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_details');
    }
};
