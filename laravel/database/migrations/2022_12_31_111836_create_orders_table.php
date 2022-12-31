<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->foreignId('user_id')->constrained();
            $table->string('product_name')->comment('その時の商品名');
            $table->unsignedInteger('price')->default(0)->comment('価格');
            $table->unsignedInteger('orders')->default(0)->comment('注文数');
            $table->unsignedInteger('tax_rate')->default(0)->comment('税率');
            $table->unsignedInteger('tax')->default(0)->comment('税額');
            $table->unsignedInteger('subtotal')->default(0)->comment('商品の小計');
            $table->unsignedInteger('shipping_charge')->default(0)->comment('配送料');
            $table->unsignedInteger('total')->default(0)->comment('請求額');
            $table->enum('payment', ['bank', 'daibiki'])->comment('支払方法');
            $table->string('postcode')->comment('配送先 郵便番号');
            $table->foreignId('prefecture_id')->constrained()->comment('配送先 都道府県ID');
            $table->string('address')->comment('配送先 住所（市区町村以下）');
            $table->string('building')->nullable()->comment('配送先 住所　建物');
            $table->string('tel')->comment('配送先 電話番号');
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
}
