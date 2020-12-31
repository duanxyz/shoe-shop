<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id');
            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onDelete('cascade');
            $table->String('photo_url');
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
        Schema::dropIfExists('photo_items');
    }
}
