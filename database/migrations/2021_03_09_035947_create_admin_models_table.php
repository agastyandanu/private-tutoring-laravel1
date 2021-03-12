<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_admin', function (Blueprint $table) {
            $table->id('admin_id');
            $table->string('admin_nama', 50);
            $table->string('admin_username', 50);
            $table->string('admin_password', 50);
            $table->string('admin_password_md5', 255);
            $table->text('admin_foto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_admin');
    }
}
