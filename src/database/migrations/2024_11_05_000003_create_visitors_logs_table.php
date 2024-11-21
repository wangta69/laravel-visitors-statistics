<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsLogsTable extends Migration

{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('visitors_logs', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('ip', 46)->nullable();
      $table->bigInteger('user_id')->unsigned()->nullable();
      $table->string('continent', 64)->nullable();
      $table->string('country', 64)->nullable();
      $table->string('city', 128)->nullable();
      $table->string('device', 32)->nullable();
      $table->string('browser', 128)->nullable();
      $table->string('referer', 255)->nullable();
      $table->timestamp('created_at');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('visitors_logs');
  }
}
