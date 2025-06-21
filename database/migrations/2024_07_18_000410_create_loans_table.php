<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->integer('num_loan');
            $table->date('date')->nullable();
            $table->enum('type_loan',['AMORTIZABLE','INTERES SIMPLE','INTERES FIJO'])->nullable();
            $table->unsignedBigInteger('partner_id');
            $table->decimal('loan_amount',10,2)->default(0)->nullable();
            $table->decimal('interest_rate_yearly',10,2)->default(0)->nullable();
            $table->decimal('interest_rate',10,2)->default(0)->nullable();
            $table->decimal('to_pay',10,2)->default(0)->nullable();
            $table->string('modality',50)->nullable();
            $table->integer('installments')->default(0)->nullable();
            $table->integer('installments_total')->default(0)->nullable();
            $table->json('payment_dates')->nullable();
            $table->string('payment_frequency',50)->nullable();
            $table->string('payment_type',50)->nullable();
            $table->decimal('interest',10,2)->default(0)->nullable();
            $table->decimal('total_interest',10,2)->default(0)->nullable();
            $table->decimal('total_to_pay',10,2)->default(0)->nullable();
            $table->decimal('final_payment',10,2)->default(0)->nullable();
            $table->integer('num_pay')->default(0)->nullable();
            $table->decimal('total_pay',10,2)->default(0)->nullable();
            $table->decimal('debt',10,2)->default(0)->nullable();
            $table->decimal('earnings',10,2)->default(0)->nullable();
            $table->text('note')->nullable();
            $table->enum('status',['Pendiente','Pagado','Cancelado'])->default('Pendiente');
            $table->enum('email_verification',['PENDIENTE','FALLIDO','ENVIADO'])->default('PENDIENTE');
            $table->timestamps();
            $table->foreign('partner_id')->references('id')->on('partners');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
