<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScoreUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $schema) {
           $schema->json('test_passed')->nullable();
           $schema->string('total_score')->default('0');
           $schema->dateTime('last_test_passed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $schema) {
            $schema->dropColumn('test_passed');
            $schema->dropColumn('total_score');
            $schema->dropColumn('last_test_passed_at');
        });
    }
}
