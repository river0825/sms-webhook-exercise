<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 收到的送達狀態事件。
     *
     * 起始表：先給最基本的欄位，面試當天可能會一起調整。
     */
    public function up(): void
    {
        Schema::create('message_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('message_sid');
            $table->string('status');
            $table->timestamp('event_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message_statuses');
    }
};
