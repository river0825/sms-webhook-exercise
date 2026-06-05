#!/usr/bin/env bash
#
# 本機測試用：對 /webhooks/sms-status 送幾筆範例事件，確認專案會動。
# 用法：./scripts/mock-webhook.sh            （預設打 http://localhost:8000）
#       ./scripts/mock-webhook.sh http://localhost:8000
#
# 之後你可以自行增減事件來測試自己的處理邏輯。
set -euo pipefail

BASE="${1:-http://localhost:8000}"
URL="$BASE/webhooks/sms-status"

send() {
  echo "POST  sid=$1  status=$2"
  curl -s -X POST "$URL" \
    -H 'Content-Type: application/json' \
    -d "{\"message_sid\":\"$1\",\"status\":\"$2\",\"event_at\":\"$3\"}"
  echo
}

send SM1001 sent      2026-06-05T10:00:00Z
send SM1001 delivered 2026-06-05T10:00:05Z
send SM1002 failed    2026-06-05T10:01:00Z
