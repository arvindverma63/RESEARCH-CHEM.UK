<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;font-size:13px;margin:12px 0 6px;">
    <thead>
        <tr>
            <th align="left" style="padding:9px 8px;border-bottom:2px solid #cbd5e1;color:#475569;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;">Product</th>
            <th align="center" style="padding:9px 8px;border-bottom:2px solid #cbd5e1;color:#475569;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;width:50px;">Qty</th>
            <th align="right" style="padding:9px 8px;border-bottom:2px solid #cbd5e1;color:#475569;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;width:80px;">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
            <tr>
                <td style="padding:10px 8px;border-bottom:1px solid #f1f5f9;color:#0f172a;vertical-align:top;">
                    <div style="font-weight:600;">{{ $row['name'] }}</div>
                </td>
                <td align="center" style="padding:10px 8px;border-bottom:1px solid #f1f5f9;color:#475569;vertical-align:top;">
                    {{ $row['qty'] }}
                </td>
                <td align="right" style="padding:10px 8px;border-bottom:1px solid #f1f5f9;color:#0f172a;font-weight:600;vertical-align:top;">
                    {{ $row['total'] }}
                </td>
            </tr>
        @endforeach
        @foreach ($discounts as $d)
            <tr>
                <td colspan="2" style="padding:7px 8px;color:#059669;font-size:12px;font-weight:600;">
                    {{ $d['name'] }}
                </td>
                <td align="right" style="padding:7px 8px;color:#059669;font-size:12px;font-weight:600;">
                    &minus;{{ $d['amount'] }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2" style="padding:7px 8px;color:#64748b;font-size:13px;">
                Tracked UK Delivery
            </td>
            <td align="right" style="padding:7px 8px;color:#64748b;font-size:13px;font-weight:600;">
                {{ $shipping }}
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding:12px 8px;border-top:2px solid #002b5c;font-weight:bold;font-size:15px;color:#002b5c;">
                Total Due
            </td>
            <td align="right" style="padding:12px 8px;border-top:2px solid #002b5c;font-weight:bold;font-size:16px;color:#002b5c;">
                {{ $total }}
            </td>
        </tr>
    </tbody>
</table>
