<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGcainfoNews extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('posts', function (Blueprint $table) {
      $table->unsignedInteger('gcainfo_id')->default(1);
      $table->foreign('gcainfo_id')->references('id')->on('gca_infos');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('posts', function (Blueprint $table) {
      $table->dropForeign('posts_gcainfo_id_foreign');
      $table->dropColumn('gcainfo_id');
    });
  }
}
