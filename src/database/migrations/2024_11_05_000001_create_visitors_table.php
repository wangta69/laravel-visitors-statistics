<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('visitors', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('ip', 46)->nullable();
      $table->string('continent', 64)->nullable();
      $table->string('country', 64)->nullable();
      $table->string('city', 128)->nullable();
      $table->string('device', 32)->nullable();
      $table->string('browser', 128)->nullable();
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
    Schema::dropIfExists('visitors');
  }
}
