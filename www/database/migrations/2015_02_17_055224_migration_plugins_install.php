<?php

use Illuminate\Database\Migrations\Migration;

class MigrationPluginsInstall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugins', function ($table) {
            $table->string('slug');
            $table->string('version')->nullable();
            $table->boolean('enabled')->default(0);
            $table->engine = 'InnoDB';
            $table->primary('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('plugins');
    }
}
