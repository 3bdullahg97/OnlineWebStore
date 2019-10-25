<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_specifications', function (Blueprint $table)
        {
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('specification_id');
            $table->text('description')->nullable(true);
            $table->timestamps();

            $table->primary(['item_id', 'specification_id']);

            $table->foreign('item_id')->references('id')->on('items')
                ->onDelete('cascade');
            $table->foreign('specification_id')->references('id')
                ->on('specifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_specifications');
    }
}
