<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>E-Ticket #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1a1a1a;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }
        .ticket-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: #4F46E5;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .header p {
            margin: 5px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }
        .content {
            padding: 30px;
            background: white;
        }
        .event-info {
            margin-bottom: 30px;
            border-bottom: 2px dashed #e5e7eb;
            padding-bottom: 20px;
        }
        .event-name {
            font-size: 22px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 10px;
        }
        .info-grid {
            width: 100%;
            margin-bottom: 20px;
        }
        .info-item {
            vertical-align: top;
            padding: 10px 0;
        }
        .label {
            font-size: 11px;
            text-transform: uppercase;
            color: #6b7280;
            font-weight: bold;
            margin-bottom: 4px;
        }
        .value {
            font-size: 14px;
            font-weight: bold;
            color: #374151;
        }
        .qr-section {
            text-align: center;
            padding: 20px;
            background: #f9fafb;
        }
        .qr-code {
            margin-bottom: 10px;
        }
        .ticket-id {
            font-family: monospace;
            font-size: 12px;
            color: #6b7280;
        }
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
        }
        .status-badge {
            display: inline-block;
            background: #ecfdf5;
            color: #059669;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    @php $event = $order->items->first()->ticket->event; @endphp
    
    <div class="ticket-container">
        <div class="header">
            <h1>EVENTIC E-TICKET</h1>
            <p>Konfirmasi Pesanan #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
        </div>
        
        <div class="content">
            <div class="event-info">
                <div class="event-name">{{ $event->name }}</div>
                <div class="status-badge">LUNAS</div>
            </div>
            
            <table class="info-grid">
                <tr>
                    <td class="info-item" width="50%">
                        <div class="label">Nama Pemesan</div>
                        <div class="value">{{ $order->user->name }}</div>
                    </td>
                    <td class="info-item" width="50%">
                        <div class="label">Email</div>
                        <div class="value">{{ $order->user->email }}</div>
                    </td>
                </tr>
                <tr>
                    <td class="info-item">
                        <div class="label">Tanggal</div>
                        <div class="value">{{ $event->date->format('d F Y') }}</div>
                    </td>
                    <td class="info-item">
                        <div class="label">Waktu</div>
                        <div class="value">{{ $event->date->format('H:i') }} WIB</div>
                    </td>
                </tr>
                <tr>
                    <td class="info-item" colspan="2">
                        <div class="label">Lokasi</div>
                        <div class="value">{{ $event->location }}</div>
                    </td>
                </tr>
            </table>

            <h3 style="font-size: 16px; margin-top: 20px; border-top: 1px solid #f3f4f6; padding-top: 20px;">Detail Tiket</h3>
            <table class="info-grid">
                @foreach($order->items as $item)
                <tr>
                    <td class="info-item" width="70%">
                        <div class="value">{{ $item->ticket->type }} x {{ $item->quantity }}</div>
                    </td>
                    <td class="info-item" width="30%" style="text-align: right;">
                        <div class="value">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td class="info-item" style="border-top: 2px solid #f3f4f6;">
                        <div class="label">Total Bayar</div>
                    </td>
                    <td class="info-item" style="border-top: 2px solid #f3f4f6; text-align: right;">
                        <div class="value" style="color: #4F46E5; font-size: 18px;">Rp{{ number_format($order->total_price, 0, ',', '.') }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="qr-section">
            <div class="qr-code">
                {{-- QR Code typically needs to be an image in PDF. SimpleQRCode can generate PNG. --}}
                {{-- However, for the PDF, we'll use base64 encoded PNG --}}
                <img src="data:image/svg+xml;base64, {!! base64_encode(SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(150)->generate(route('user.tickets.download', $order))) !!} ">
            </div>
            <div class="ticket-id">SCAN UNTUK VERIFIKASI</div>
            <div class="ticket-id" style="margin-top: 5px;">ID: TKT-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
        </div>

        <div class="footer">
            <p>Terima kasih telah membeli tiket melalui Eventic.</p>
            <p>Harap bawa e-ticket ini (cetak atau digital) saat kedatangan untuk proses check-in.</p>
        </div>
    </div>
</body>
</html>
