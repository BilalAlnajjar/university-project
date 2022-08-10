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
        Schema::create('subject_general_plan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("general_plan_id");
            $table->unsignedBigInteger("subject_id");
            $table->timestamps();

            $table->foreign("general_plan_id")->references("id")->on("general_plans")->cascadeOnDelete();
            $table->foreign("subject_id")->references("id")->on("subjects")->cascadeOnDelete();
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
