<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('domains', static function (Blueprint $table) {
            $table->unsignedInteger('content_length')->nullable();
            $table->unsignedSmallInteger('code')->nullable();
            $table->text('body')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('domains', static function (Blueprint $table) {
            $table->dropColumn('content_length', 'code', 'body');
        });
    }
}
