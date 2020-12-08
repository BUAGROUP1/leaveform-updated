<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TheleaveformTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theleaveform', function (Blueprint $table) {
            $table->id();
            $table->string('StaffID')->nullable();
            $table->date('date')->nullable();
            $table->string('name')->nullable();
            $table->string('sapno')->nullable();
            $table->string('cadre')->nullable();
            $table->string('department')->nullable();
            $table->string('shift')->nullable();
            $table->string('leavetype')->nullable();
            $table->longText('reason')->nullable();
            $table->string('leaveyear')->nullable();
            $table->string('entitledleave')->nullable();
            $table->string('daystaken')->nullable();
            $table->string('totdaysvac')->nullable();
            $table->string('outstanding')->nullable();
            $table->string('publicholidays')->nullable();
            $table->date('lcommences')->nullable();
            $table->date('lends')->nullable();
            $table->date('rdate')->nullable();
            $table->longText('contact_add')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('decl')->nullable();
            $table->string('decl_sig')->nullable();
            $table->date('decl_date')->nullable();
            $table->date('decl_name')->nullable();
            $table->date('decl_email')->nullable();
            $table->string('super_sig')->nullable();
            $table->date('super_date')->nullable();
            $table->string('super_name')->nullable();
            $table->string('super_email')->nullable();
            $table->string('hod_sig')->nullable();
            $table->date('hod_date')->nullable();
            $table->string('hod_name')->nullable();
            $table->string('hod_email')->nullable();
            $table->string('hr_sig')->nullable();
            $table->date('hr_date')->nullable();
            $table->string('hr_name')->nullable();
            $table->string('hr_email')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('theleaveform');
    }
}
