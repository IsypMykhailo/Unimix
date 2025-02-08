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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('publication_id');
            $table->timestamps();

            // Foreign key constraint to 'users' table
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');

            // Foreign key constraint to 'publications' table
            $table->foreign('publication_id')->references('id')->on('publications')
                ->onDelete('cascade');

            // Optional: To prevent a user from liking the same publication more than once
            $table->unique(['user_id', 'publication_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
};
