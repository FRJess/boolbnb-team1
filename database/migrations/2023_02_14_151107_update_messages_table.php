<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->unsignedBigInteger('property_id')->nullable()->after('id');
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
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
        Schema::table('messages', function (Blueprint $table) {
            if (DB::getDriverName() !== 'sqlite'){
                $table->dropForeign(['property_id']);
            }
            $table->dropColumn('property_id');
        });
    }
};
