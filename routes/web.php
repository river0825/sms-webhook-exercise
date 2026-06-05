<?php

use App\Http\Controllers\SmsStatusWebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 環境自我檢查用：候選人 docker compose up 後打這支確認專案會動。
Route::get('/ping', function () {
    return response()->json([
        'ok' => true,
        'service' => 'sms-webhook-exercise',
    ]);
});

// 電信商回報簡訊送達狀態的 webhook（外部 POST）。
Route::post('/webhooks/sms-status', [SmsStatusWebhookController::class, 'handle']);
