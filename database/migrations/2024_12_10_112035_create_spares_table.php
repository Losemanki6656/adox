<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparesTable extends Migration
{

    public function up()
    {
        Schema::create('spares', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('type')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('spares');
    }
}
