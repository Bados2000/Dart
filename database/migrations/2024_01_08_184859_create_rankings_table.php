<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rankings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
            $table->integer('position')->default(0); // Pozycja w rankingu
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rankings');
    }
};
