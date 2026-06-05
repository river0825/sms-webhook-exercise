# SMS Webhook Exercise（Step 7 起始專案）

這是一個**最小可跑的全端專案**（**Laravel 12 後端 API + React 前端**），給團隊面試（Step 7）當天的協作實作題使用。

面試當天我們會一起在這個專案上做一小段功能，跟「**簡訊送達狀態的處理**」有關。
**這不是考試，重點是我們一起合作的過程**，不是你有沒有寫完——所以放輕鬆，當天細節會當場說明。

你只需要在面試前確認這個專案在你電腦上**跑得起來**就好。

---

## 你需要準備的

- **Docker / Docker Compose**（必要）
- 你**平常慣用的 AI 編碼工具**（Claude Code / Copilot / Cursor / …）——這場明確歡迎你用 AI，這就是你的正常工具。
  （現場我們也會備一組公司帳號的環境，你想用我們的也可以。）
- 你慣用的編輯器 / IDE
- 本機**不一定**要裝 PHP / Composer / Node，容器內都有。

## 怎麼跑起來（一個指令）

```bash
git clone https://github.com/river0825/sms-webhook-exercise.git
cd sms-webhook-exercise
docker compose up --build   # 會自動 cp .env.example .env
```

第一次會 build image、裝 composer / npm 依賴、跑 migration + seed，然後啟動三個服務：

| 服務 | 網址 | 說明 |
|---|---|---|
| 前端 React（Vite）| <http://localhost:5173> | 你主要會看的頁面 |
| 後端 Laravel API | <http://localhost:8000> | 前端 `/api/*` 會 proxy 到這 |
| MySQL | （內部）`db:3306` | 資料庫 |

## 確認專案會動

開另一個終端機：

```bash
# 1) 後端健康檢查
curl http://localhost:8000/ping
# 預期：{"ok":true,"service":"sms-webhook-exercise"}

# 2) 後端 API（前端就是讀這支）
curl http://localhost:8000/api/messages
# 預期：一個 JSON 陣列，內含 3 筆範例訊息

# 3) 送幾筆範例 webhook 事件
./scripts/mock-webhook.sh
# 預期：每筆回 {"received":true}
```

最後**打開瀏覽器 <http://localhost:5173>**，看到一個列出範例訊息的表格，就代表前後端都通了。🎉

## 這個專案裡有什麼

**後端（Laravel 12，專案根目錄）**
- `routes/web.php` — `/ping` 健康檢查、`/webhooks/sms-status`（webhook 進入點）、`/api/messages`（給前端讀）
- `app/Http/Controllers/SmsStatusWebhookController.php` — webhook handler（目前先回 200，邏輯當天一起補）
- `app/Models/Message.php`
- `database/migrations/` — `messages`、`message_statuses` 兩張起始表
- `database/seeders/DatabaseSeeder.php` — 幾則範例訊息
- `scripts/mock-webhook.sh` — 本機送測試事件的小腳本

**前端（React + Vite，`frontend/`）**
- `frontend/src/App.jsx` — 開頁打 `/api/messages` 並列出訊息（最小版，當天可能一起加東西）
- `frontend/vite.config.js` — `/api`、`/webhooks` 都 proxy 到後端，所以前端不用處理 CORS

## 卡關了？

如果 `docker compose up` 或上面的檢查有任何問題，**面試前一天先跟我們說一聲**，我們幫你排除，當天就能直接進入協作。
