<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('name')->change()->nullable();
            $table->string('converted_name')->change()->nullable();
            $table->string('email')->change()->nullable();
            $table->string('tel')->change()->nullable();
            $table->boolean('tel_reserved_flag')->after('tel')->default(0)->comment('電話予約かどうかのフラグ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
