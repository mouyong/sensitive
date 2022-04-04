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
        Schema::create('adjudication_detections', function (Blueprint $table) {
            $table->comment = '众审检测';

            $table->id();
            $table->string('type')->index()->comment('检测类型');
            $table->string('no')->index()->comment('检测信息编号');
            $table->string('state')->index()->comment('检测结果');
            $table->json('extra')->nullable()->comment('扩展信息');
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
        Schema::dropIfExists('adjudication_detections');
    }
};
