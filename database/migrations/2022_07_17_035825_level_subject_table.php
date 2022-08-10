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
        Schema::create('level_subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("level_id");
            $table->unsignedBigInteger("subject_id");
            $table->timestamps();

            $table->foreign("level_id")->references("id")->on("levels")->cascadeOnDelete();
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
