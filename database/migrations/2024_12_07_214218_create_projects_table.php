<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateProjectsTable extends Migration
    {

        public function up()
        {
            Schema::create('projects', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->integer('parent_id')->index()->nullable();
                $table->string('coordinate', 50)->nullable();
                $table->string('address')->nullable();
                $table->string('client_name')->nullable();
                $table->bigInteger('phone')->nullable();
                $table->bigInteger('amount')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }


        public function down()
        {
            Schema::dropIfExists('projects');
        }
    }
