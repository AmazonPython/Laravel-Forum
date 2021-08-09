<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('threads', function (Blueprint $table) {
            $table->unsignedBigInteger('best_reply_id')
                ->nullable()
                ->after('replies_count');

            $table->foreign('best_reply_id')
                ->references('id')
                ->on('replies')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('threads', function (Blueprint $table) {
            $table->dropForeign(['best_reply_id']);
            $table->dropColumn('best_reply_id');
        });
    }
}
