<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('products', function (Blueprint $table) {
            $table->string("name")->nullable()->change();
            $table->text("description")->nullable()->change();
            $table->string("tags")->nullable()->change();
            $table->string("sku")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Khôi phục các cột về trạng thái ban đầu, nếu có
            $table->string("name")->nullable(false)->change();
            $table->text("description")->nullable(false)->change();
            $table->string("tags")->nullable(false)->change();
            $table->string("sku")->nullable(false)->change();
        });
    }
};
