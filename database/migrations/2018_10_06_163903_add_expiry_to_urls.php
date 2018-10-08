<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExpiryToUrls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('urls', function (Blueprint $table) {
            $table->timestamp('expires_at')->nullable()->after('short_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('urls', function (Blueprint $table) {
            $table->dropColumn('expires_at');
        });
    }
}
