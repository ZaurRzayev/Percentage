<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('UserFullName');
            $table->date('NewDate');
            $table->string('PostTitle');
            $table->unsignedBigInteger('PostId');
            $table->string('BusinessName');
            $table->unsignedBigInteger('UserId');
            $table->unsignedBigInteger('BusinessId');
            $table->unsignedBigInteger('jobId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['UserFullName', 'NewDate', 'PostTitle', 'PostId', 'BusinessName', 'UserId', 'BusinessId', 'jobId']);
        });
    }
};
