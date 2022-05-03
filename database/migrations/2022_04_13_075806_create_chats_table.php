<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('chatId')->nullable();
            $table->string('companyName')->nullable();
            $table->integer('leadType')->nullable();
            $table->string('companyKey')->nullable();
            $table->string('pickedUpOn')->nullable();
            $table->longText('referrer')->nullable();
            $table->string('ipAddress')->nullable();
            $table->string('endedOn')->nullable();
            $table->longText('location')->nullable();

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
        Schema::dropIfExists('chats');
    }
}
