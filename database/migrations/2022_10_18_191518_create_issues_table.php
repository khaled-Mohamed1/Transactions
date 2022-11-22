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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->text('issue_NO');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('court_name')->nullable();
            $table->string('case_number')->nullable();
            $table->string('case_amount')->nullable();
            $table->string('execution_request')->nullable();
            $table->string('execution_agent_name')->nullable();
            $table->string('execution_agent_against_it')->nullable();
            $table->string('customer_qty')->nullable();
            $table->string('issue_status')->default('تم فتح قضية تنفيذية');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('issues');
    }
};
