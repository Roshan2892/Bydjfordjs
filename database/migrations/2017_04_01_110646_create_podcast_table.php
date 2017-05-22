<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePodcastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('podcasts', function(Blueprint $table){
            $table->increments('id');
            $table->string('title', 100);
            $table->longText('description',500);
            $table->string('poster',500);
            $table->string('file',500);
            $table->string('filename',500);
            $table->text('artist',60);
            $table->string('tags');
            $table->string('language',15);
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
       Schema::dropIfExists('podcasts');
    }
}
