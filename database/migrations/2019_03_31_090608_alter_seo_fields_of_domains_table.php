<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSeoFieldsOfDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('domains', static function (Blueprint $table) {
            $table->text('h1')->nullable()->change();
            $table->text('keywords')->nullable()->change();
            $table->text('description')->nullable()->change();
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
            $table->string('h1')->nullable()->change();
            $table->string('keywords')->nullable()->change();
            $table->string('description')->nullable()->change();
        });
    }
}
