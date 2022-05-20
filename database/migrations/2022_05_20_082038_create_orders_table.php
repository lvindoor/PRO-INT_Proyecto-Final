<?php

use App\Models\Order;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table  ->foreignId('user_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table  ->foreignId('department_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table  ->foreignId('city_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table  ->foreignId('district_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->enum('status', [
                                    Order::PENDING,
                                    Order::RECEIVED,
                                    Order::SEND,
                                    Order::DELIVERED,
                                    Order::CANCELED
                                ])->default(Order::PENDING);

            $table->enum('shipping_type', [Order::IN_PACKAGE, Order::AT_HOME]);

            $table->float('shipping_cost');
            $table->float('total');
            $table->json('content');
            $table->string('address',250);

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
        Schema::dropIfExists('orders');
    }
};
