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
        Schema::create('department_sub_major', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("department_id");
            $table->unsignedBigInteger("sub_major_id");
            $table->timestamps();

            $table->foreign("department_id")->references("id")->on("departments")->cascadeOnDelete();
            $table->foreign("sub_major_id")->references("id")->on("sub_majors")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
