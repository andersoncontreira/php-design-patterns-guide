<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('order_code', 48)->nullable(false);

            $table->string('currency', 3)->nullable(false);
            $table->decimal('amount')->nullable(false);

            $table->integer('customer_id')->nullable(false);
            // default
            $table->string('uuid', 36)->nullable(false);
            $table->integer('active')->nullable(false)->default(1);
            $table->timestamp('created_at')->nullable(true)->useCurrent();
            $table->timestamp('updated_at')->nullable(true);
            $table->timestamp('deleted_at')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
