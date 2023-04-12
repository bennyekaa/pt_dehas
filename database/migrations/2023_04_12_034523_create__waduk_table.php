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
        Schema::create('Waduk_table', function (Blueprint $table) {
            $table->id();
            $table->decimal('muka_air', 10, 2);
            $table->decimal('tinggi_air', 10, 2);
            $table->decimal('debit_keluar', 10, 2);
            $table->integer('status');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Waduk_table');
    }
};
