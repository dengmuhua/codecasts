<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->comment('系统名称');
            $table->string('tel')->nullable()->comment('联系电话');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('address')->nullable()->comment('地址');
            $table->string('logo')->nullable()->comment('logo');
            $table->string('icon')->nullable()->comment('icon');
            $table->string('keywords')->nullable()->comment('关键字');
            $table->string('description')->nullable()->comment('描述');
            $table->string('copyright')->nullable()->comment('版权');
            $table->string('icp')->nullable()->comment('ICP');
            $table->string('statistics')->nullable()->comment('统计代码');
            $table->json('config')->nullable()->comment('自定义配置');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
