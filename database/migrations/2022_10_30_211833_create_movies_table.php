<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('genre');
            $table->string('year');
            $table->string('image')->nullable();
            $table->integer('recommended')->default(0);
            $table->integer('notRecommended')->default(0);
            $table->timestamp('ended_at')->nullable();
            $table->foreignId('users_id')
            ->constrained('users');
            

            $table->softDeletes();
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
        Schema::dropIfExists('movies');
    }
}
