# SMS Webhook Exercise（Step 7 起始專案）

這是一個**最小可跑的 Laravel 12 專案**，給團隊面試（Step 7）當天的協作實作題使用。

面試當天我們會一起在這個專案上做一小段功能，跟「**簡訊送達狀態的處理**」有關。
**這不是考試，重點是我們一起合作的過程**，不是你有沒有寫完——所以放輕鬆，當天細節會當場說明。

你只需要在面試前確認這個專案在你電腦上**跑得起來**就好。

---

## 你需要準備的

- **Docker / Docker Compose**（必要）
- 你**平常慣用的 AI 編碼工具**（Claude Code / Copilot / Cursor / …）——這場明確歡迎你用 AI，這就是你的正常工具。
  （現場我們也會備一組公司帳號的環境，你想用我們的也可以。）
- 你慣用的編輯器 / IDE
- 本機**不一定**要裝 PHP / Composer，容器內都有。

## 怎麼跑起來（一個指令）

```bash
git clone <THIS_REPO_URL>
cd step7-exercise
cp .env.example .env   # 若 .env 已內附可略過
docker compose up --build
```

第一次會先 build image、裝 composer 依賴、跑 migration + seed，然後啟動服務。
看到 `Server running on http://0.0.0.0:8000` 就成功了。

## 確認專案會動

開另一個終端機：

```bash
# 1) 健康檢查
curl http://localhost:8000/ping
# 預期：{"ok":true,"service":"sms-webhook-exercise"}

# 2) 送幾筆範例 webhook 事件
./scripts/mock-webhook.sh
# 預期：每筆回 {"received":true}
```

兩個都正常，就代表環境 OK，面試當天可以直接開始。🎉

## 這個專案裡有什麼

- `routes/web.php` — `/ping` 健康檢查 + `/webhooks/sms-status`（webhook 進入點）
- `app/Http/Controllers/SmsStatusWebhookController.php` — webhook handler（目前先回 200，邏輯當天一起補）
- `database/migrations/` — `messages`、`message_statuses` 兩張起始表
- `database/seeders/DatabaseSeeder.php` — 幾則範例訊息
- `scripts/mock-webhook.sh` — 本機送測試事件的小腳本

## 卡關了？

如果 `docker compose up` 或上面的 curl 有任何問題，**面試前一天先跟我們說一聲**，我們幫你排除，當天就能直接進入協作。
