<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 我們送出的簡訊。電信商之後會非同步回報每一則的送達狀態。
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('message_sid')->index(); // 電信商給的訊息編號
            $table->string('to');
            $table->text('body');
            $table->string('status')->default('queued'); // queued / sent / delivered / undelivered / failed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
