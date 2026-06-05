import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// React 前端開發伺服器。/api 與 /webhooks 都代理到 Laravel（app:8000），
// 這樣前端 fetch('/api/messages') 就不用處理 CORS。
export default defineConfig({
  plugins: [react()],
  server: {
    host: true,
    port: 5173,
    watch: { usePolling: true }, // Docker 掛載 volume 在 macOS 上需要 polling 才偵測得到檔案變更
    proxy: {
      '/api': 'http://app:8000',
      '/webhooks': 'http://app:8000',
    },
  },
})
