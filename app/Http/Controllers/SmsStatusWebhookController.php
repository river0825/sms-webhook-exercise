<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SmsStatusWebhookController extends Controller
{
    /**
     * 簡訊送達狀態 webhook 的進入點。
     *
     * 電信商（類似 Twilio）會在簡訊送出後，「事後非同步」打這支回報最終狀態。
     * payload 範例：
     *   { "message_sid": "SM1001", "status": "delivered", "event_at": "2026-06-05T10:00:05Z" }
     *
     * 目前先回 200 讓 pipeline 跑得起來；實際處理邏輯面試當天一起實作。
     */
    public function handle(Request $request): JsonResponse
    {
        // TODO（面試當天一起做）
        return response()->json(['received' => true]);
    }
}
