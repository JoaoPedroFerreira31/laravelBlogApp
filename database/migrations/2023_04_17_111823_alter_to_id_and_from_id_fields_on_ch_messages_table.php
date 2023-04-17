<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterToIdAndFromIdFieldsOnChMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ch_messages', function (Blueprint $table) {
            $table->uuid('to_id')->change();
            $table->uuid('from_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ch_messages', function (Blueprint $table) {
            //
        });
    }
}
