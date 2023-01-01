<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('商品名');
            $table->string('subtitle')->comment('商品名の下のキャッチコピー');
            $table->string('image_file_path')->nullable()->comment('商品画像のファイルパス');
            $table->longText('description')->comment('商品説明');
            $table->unsignedInteger('price')->default(0)->comment('価格');
            $table->unsignedInteger('stock')->default(0)->comment('在庫数');
            $table->foreignId('product_category_id')->constrained()->nullable()->comment('カテゴリ');
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
        Schema::dropIfExists('products');
    }
}
