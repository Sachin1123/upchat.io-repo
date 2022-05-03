<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('leadId')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('chatId')->nullable();
            $table->string('name')->nullable();
            $table->string('domain')->nullable();
            $table->string('email')->nullable();
            $table->string('companyName')->nullable();
            $table->integer('leadType')->nullable();
            $table->string('categoryId')->nullable();
            $table->set('leadStatus', ['Valid', 'Invalid','Resolve'])->default('Valid');
            $table->integer('companyId')->nullable();
            $table->string('companyKey')->nullable();
            $table->string('phone')->nullable();
            $table->string('username')->nullable();
            $table->longText('reason')->nullable();
            $table->string('ipAddress')->nullable();
            $table->string('rejectReason')->nullable();
            $table->longText('invalid_reason')->nullable();

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
        Schema::dropIfExists('leads');
    }
}
