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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->text('customer_NO');
            $table->string('full_name')->nullable();
            $table->string('ID_NO')->nullable()->unique();
            $table->string('phone_NO')->nullable();
            $table->string('region')->nullable();
            $table->string('address')->nullable();
            $table->string('status')->default('جديد');
            $table->string('reserve_phone_NO')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('number_of_children')->nullable();
            $table->string('job')->nullable();
            $table->float('salary')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_account_NO')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->float('account')->default('0');
            $table->text('notes')->nullable();
            $table->boolean('repeater')->default(false);
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
        Schema::dropIfExists('customers');
    }
};
