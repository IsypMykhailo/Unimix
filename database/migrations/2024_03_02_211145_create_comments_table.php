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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('publication_id');
            $table->text('text');
            $table->timestamps();

            // Assuming 'users' and 'publications' tables exist
            // Foreign key constraint to 'users' table
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');

            // Foreign key constraint to 'publications' table
            $table->foreign('publication_id')->references('id')->on('publications')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
