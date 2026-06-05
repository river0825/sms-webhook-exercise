<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * 塞幾則「已送出、等待狀態回報」的範例訊息，方便本機測試 webhook。
     */
    public function run(): void
    {
        $now = now();

        DB::table('messages')->insert([
            ['message_sid' => 'SM1001', 'to' => '+14155550101', 'body' => 'Your verification code is 482913', 'status' => 'sent', 'created_at' => $now, 'updated_at' => $now],
            ['message_sid' => 'SM1002', 'to' => '+14155550102', 'body' => 'Welcome to ConvoAI!', 'status' => 'sent', 'created_at' => $now, 'updated_at' => $now],
            ['message_sid' => 'SM1003', 'to' => '+14155550103', 'body' => 'Reminder: your appointment is at 3pm.', 'status' => 'sent', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
