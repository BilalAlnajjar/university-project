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
        Schema::create('sub_subject_link', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("sub_subject_id");
            $table->unsignedBigInteger("link_id");
            $table->timestamps();

            $table->foreign("sub_subject_id")->references("id")->on("sup_subjects")->cascadeOnDelete();
            $table->foreign("link_id")->references("id")->on("links")->cascadeOnDelete();
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
