<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarkGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mark_grades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('grade_name');
            $table->string('grade_point');
            $table->string('start_mark');
            $table->string('end_mark');
            $table->string('start_point');
            $table->string('end_point');
            $table->string('remarks');
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
        Schema::dropIfExists('mark_grades');
    }
}
