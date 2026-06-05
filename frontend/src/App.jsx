import { useEffect, useState } from 'react'

// 最小可跑的「訊息狀態」頁：開頁時打後端 /api/messages，列出訊息。
// 面試當天我們可能會一起在這上面加東西（例如顯示每則的最新送達狀態）。
export default function App() {
  const [messages, setMessages] = useState([])
  const [error, setError] = useState(null)

  useEffect(() => {
    fetch('/api/messages')
      .then((res) => {
        if (!res.ok) throw new Error(`HTTP ${res.status}`)
        return res.json()
      })
      .then(setMessages)
      .catch((e) => setError(e.message))
  }, [])

  return (
    <main style={{ fontFamily: 'system-ui, sans-serif', maxWidth: 720, margin: '40px auto', padding: '0 16px' }}>
      <h1>SMS Messages</h1>
      <p style={{ color: '#666' }}>
        Step 7 起始前端（Laravel API + React）。資料來自後端 <code>/api/messages</code>。
      </p>

      {error && <p style={{ color: 'crimson' }}>讀取失敗：{error}</p>}

      <table style={{ borderCollapse: 'collapse', width: '100%' }}>
        <thead>
          <tr>
            <th style={th}>SID</th>
            <th style={th}>To</th>
            <th style={th}>Body</th>
            <th style={th}>Status</th>
          </tr>
        </thead>
        <tbody>
          {messages.map((m) => (
            <tr key={m.id}>
              <td style={td}>{m.message_sid}</td>
              <td style={td}>{m.to}</td>
              <td style={td}>{m.body}</td>
              <td style={td}>{m.status}</td>
            </tr>
          ))}
          {messages.length === 0 && !error && (
            <tr>
              <td style={td} colSpan={4}>（沒有資料 / 載入中…）</td>
            </tr>
          )}
        </tbody>
      </table>
    </main>
  )
}

const th = { textAlign: 'left', borderBottom: '2px solid #ddd', padding: '8px' }
const td = { borderBottom: '1px solid #eee', padding: '8px' }
