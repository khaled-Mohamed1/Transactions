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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->text('transaction_NO');
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('transactions_type')->nullable();
            $table->float('transaction_amount')->nullable();
            $table->float('first_payment')->nullable();
            $table->float('transaction_rest')->nullable();
            $table->float('monthly_payment')->nullable();
            $table->date('date_of_first_payment')->nullable();
            $table->string('draft_NO')->default(4);
            $table->string('agency_NO')->default(4);
            $table->string('endorsement_NO')->default(1);
            $table->string('receipt_NO')->default(1);
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
        Schema::dropIfExists('transactions');
    }
};
