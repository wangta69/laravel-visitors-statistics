<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsStatisticsTable extends Migration

{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('visitors_statistics', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->date('date');
      $table->enum('type', ['all', 'unique']);
      $table->integer('value')->default(0);
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
    Schema::dropIfExists('visitors_statistics');
  }
}
