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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();

            $table  ->foreignId('district_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->string('model',150);
            $table->boolean('active')->default(true);
            $table->string('ip',25);
            $table->string('hostname',150);

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
        Schema::dropIfExists('machines');
    }
};
