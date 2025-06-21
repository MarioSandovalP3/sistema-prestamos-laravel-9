<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('address',255);
            $table->string('city',100);
            $table->string('state',100);
            $table->string('postal_code',50)->nullable();
            $table->string('website',255)->nullable();
            $table->string('email',255);
            $table->string('phone',50);
            $table->string('movil',50)->nullable();
            $table->string('rif',100)->nullable();
            $table->string('slogan',255)->nullable();    
            $table->text('us')->nullable();
            $table->text('iframe_map')->nullable();
            $table->string('image',255)->nullable();
            $table->string('ico',255)->nullable();
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
        Schema::dropIfExists('companies');
    }
}
