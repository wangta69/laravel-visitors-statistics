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
      $table->string('ip', 46);
      $table->bigInteger('user_id')->unsigned()->nullable();
      $table->string('continent', 64);
      $table->string('country', 64);
      $table->string('city', 128);
      $table->string('device', 32);
      $table->string('browser', 128);
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
