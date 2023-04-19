<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterToIdAndFromIdFieldsOnChFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ch_favorites', function (Blueprint $table) {
            $table->uuid('user_id')->change();
            $table->uuid('favorite_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ch_favorites', function (Blueprint $table) {
            //
        });
    }
}
