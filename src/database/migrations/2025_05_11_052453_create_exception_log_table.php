<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExceptionLogTable extends Migration
{
    public function up()
    {
        Schema::create('exception_logs', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('message');
            $table->text('trace')->nullable();
            $table->string('file')->nullable();
            $table->integer('line')->nullable();
            $table->string('code')->nullable();
            $table->string('url')->nullable();
            $table->string('method')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->json('headers')->nullable();
            $table->json('input')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('url');
        });
    }

    public function down()
    {
        Schema::dropIfExists('exception_logs');
    }
}
