<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tenant_id')->index();
            $table->string("module", 15)->index();
            $table->string("module_key", 15)->index();
            $table->string("module_value", 55)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenant_configs');
    }
}
