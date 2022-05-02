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
            $table->string('number', 50);
            $table->date('date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('product_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->decimal('amount_collection', 8, 2)->nullable();;
            $table->decimal('amount_commission', 8, 2);
            $table->decimal('discount', 8, 2)->default(0);
            $table->decimal('value_vat', 8, 2);
            $table->unsignedTinyInteger('rate_vat');
            $table->decimal('total', 8, 2);
            $table->integer('type');
            $table->text('note')->nullable();
            $table->string('user');
            $table->text('image')->nullable();
            $table->date('payment_date')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
