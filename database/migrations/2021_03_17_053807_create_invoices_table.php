<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_mail')->nullable();
            $table->string('company')->nullable();
            $table->string('address')->nullable();
            $table->string('item')->nullable();
            $table->string('product_name')->nullable();
            $table->string('price')->nullable();
            $table->integer('quantity');
            $table->string('total');
            $table->string('payment');
            $table->string('due');
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
        Schema::dropIfExists('invoices');
    }
}
