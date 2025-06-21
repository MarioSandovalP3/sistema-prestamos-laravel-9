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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id');
            $table->date('date')->nullable();
            $table->json('payment_dates')->nullable();
            $table->decimal('to_pay',10,2)->default(0)->nullable();
            $table->string('payment_method',100);
            $table->text('note')->nullable();
            $table->enum('email_verification',['PENDIENTE','FALLIDO','ENVIADO'])->default('PENDIENTE');
            $table->integer('num_pay')->default(0)->nullable();
            $table->integer('remaining_payments')->default(0)->nullable();
            $table->decimal('total_pay',10,2)->default(0)->nullable();
            $table->decimal('debt',10,2)->default(0)->nullable();
            $table->enum('status',['Registrado','Anulado'])->default('Registrado');
            $table->timestamps();
            $table->foreign('loan_id')->references('id')->on('loans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
