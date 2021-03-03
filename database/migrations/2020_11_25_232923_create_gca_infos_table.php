<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGcaInfosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('gca_infos', function (Blueprint $table) {
      $table->increments('id');
      $table->string('prefix', 3)->nullable();
      $table->string('title')->nullable();
      $table->string('name')->nullable();
      $table->string('phone')->nullable();
      $table->string('address')->nullable();
      $table->string('wep')->nullable();
      $table->string('email')->nullable();
      $table->integer('transnational')->nullable();
      $table->integer('bilateral')->nullable();
      $table->timestamps();
    });

    $gca = new \App\GcaInfo();
    $gca->prefix = 'UZ';
    $gca->title = 'Gca Info on Uzbekistan';
    $gca->name = 'Uzbekistan';
    $gca->phone = '+998 71-233-69-46';
    $gca->address = '100000, Ташкент, ул. Амира Темура, 3';
    $gca->wep = 'https://www.mfa.uz';
    $gca->email = 'https://www.mfa.uz';
    $gca->transnational = 10;
    $gca->bilateral = 6;
    $gca->save();

    $gca = new \App\GcaInfo();
    $gca->prefix = 'KZ';
    $gca->title = 'Gca Info on Kazakhstan';
    $gca->name = 'Kazakhstan';
    $gca->phone = '+998 71-233-69-46';
    $gca->address = '100000, Ташкент, ул. Амира Темура, 3';
    $gca->wep = 'https://www.mfa.uz';
    $gca->email = 'https://www.mfa.uz';
    $gca->transnational = 10;
    $gca->bilateral = 6;
    $gca->save();

    $gca = new \App\GcaInfo();
    $gca->prefix = 'TM';
    $gca->title = 'Gca Info on Turkmenistan';
    $gca->name = 'Turkmenistan';
    $gca->phone = '+998 71-233-69-46';
    $gca->address = '100000, Ташкент, ул. Амира Темура, 3';
    $gca->wep = 'http://www.mfa.gov.tm';
    $gca->email = 'https://www.mfa.uz';
    $gca->transnational = 10;
    $gca->bilateral = 6;
    $gca->save();

    $gca = new \App\GcaInfo();
    $gca->prefix = 'KG';
    $gca->title = 'Gca Info on Kyrgyzstan';
    $gca->name = 'Kyrgyzstan';
    $gca->phone = '+998 71-233-69-46';
    $gca->address = '100000, Ташкент, ул. Амира Темура, 3';
    $gca->wep = 'http://www.mfa.gov.kg';
    $gca->email = 'https://www.mfa.uz';
    $gca->transnational = 10;
    $gca->bilateral = 6;
    $gca->save();

    $gca = new \App\GcaInfo();
    $gca->prefix = 'AF';
    $gca->title = 'Gca Info on Afghanistan';
    $gca->name = 'Afghanistan';
    $gca->phone = '+998 71-233-69-46';
    $gca->address = '100000, Ташкент, ул. Амира Темура, 3';
    $gca->wep = 'http://www.mfa.gov.af';
    $gca->email = 'https://www.mfa.uz';
    $gca->transnational = 10;
    $gca->bilateral = 6;
    $gca->save();

    $gca = new \App\GcaInfo();
    $gca->prefix = 'TJ';
    $gca->title = 'Gca Info on Tajikistan';
    $gca->name = 'Tajikistan';
    $gca->phone = '+998 71-233-69-46';
    $gca->address = '100000, Ташкент, ул. Амира Темура, 3';
    $gca->wep = 'http://www.mfa.tj';
    $gca->email = 'https://www.mfa.uz';
    $gca->transnational = 10;
    $gca->bilateral = 6;
    $gca->save();
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('gca_infos');
  }
}
