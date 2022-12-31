<?php

use App\Models\Prefecture;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->comment('ユーザーID');
            $table->string('postcode')->comment('郵便番号');
            $table->foreignIdFor(Prefecture::class)->comment('都道府県ID');
            $table->string('address')->comment('住所（市区町村以下）');
            $table->string('building')->nullable()->comment('住所　建物');
            $table->string('tel')->comment('電話番号');
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
        Schema::dropIfExists('profiles');
    }
}
