<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IndexingColumns extends Migration
{
    public function up()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->string('first_name', 50)->change();
            $table->string('last_name', 50)->change();
            $table->index(['first_name', 'last_name']);
            $table->index('first_name');
            $table->index('last_name');
        });

        Schema::table('brands', function(Blueprint $table)
        {
            $table->string('name', 50)->change();
            $table->index('name');
        });

        Schema::table('items', function(Blueprint $table)
        {
            $table->string('name', 50)->change();
            $table->index('name');
            $table->index('price');
        });

        Schema::table('categories', function(Blueprint $table)
        {
            $table->string('name', 50)->change();
            $table->index('name');
        });

        Schema::table('specifications', function(Blueprint $table)
        {
            $table->string('name', 50)->change();
            $table->index('name');
        });

        Schema::table('specification_groups', function(Blueprint $table)
        {
            $table->string('group_name', 50)->change();
            $table->index('group_name');
        });

        Schema::table('item_specifications', function(Blueprint $table)
        {
            $table->string('description', 500)->change();
            $table->index('description');
        });
    }

    public function down()
    {

    }
}
