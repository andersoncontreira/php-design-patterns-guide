<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('products', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('sku')->nullable(false);

            $table->string('name', 255)->nullable(false);
            $table->string('description', 255)->nullable(false);
            $table->integer('supplier_id')->nullable(false);
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
        Schema::drop('products');
    }
}
