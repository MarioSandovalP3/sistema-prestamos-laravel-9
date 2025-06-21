<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('image',255)->nullable();
            $table->string('name',255);
            $table->string('cedula',50)->nullable();
            $table->string('address',255)->nullable();
            $table->string('contry',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('postal_code',50)->nullable();
            $table->string('phone',25)->nullable();
            $table->string('movil',25)->nullable();
            $table->string('email',255)->nullable();
            $table->string('website',255)->nullable();
            $table->decimal('debt',10,2)->default(0)->nullable();
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
        Schema::dropIfExists('partners');
    }
}
