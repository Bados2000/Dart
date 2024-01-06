<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
public function up()
{
Schema::create('settings', function (Blueprint $table) {
$table->id();
$table->unsignedBigInteger('user_id'); // Dodajemy kolumnę user_id
$table->enum('camera', ['default', 'external']); // Kamera domyślna lub internetowa
$table->string('camera_ip')->nullable(); // Adres IP kamery internetowej
$table->boolean('auto_scoring')->default(false); // System automatycznego zliczania punktów
$table->string('websocket_server_ip')->nullable(); // Adres IP serwera websocket
$table->timestamps();

// Definicja klucza obcego
$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});
}

public function down()
{
Schema::dropIfExists('settings');
}
}
