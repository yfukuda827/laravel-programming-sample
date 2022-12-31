<?php

use App\Models\ProductCategory;
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
            $table->string('image_file_path')->nullable()->comment('商品画像のファイルパス');
            $table->longText('description')->comment('商品説明');
            $table->unsignedInteger('price')->default(0)->comment('価格');
            $table->unsignedInteger('stock')->default(0)->comment('在庫数');
            $table->foreignIdFor(ProductCategory::class)->nullable()->comment('カテゴリ');
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
