<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;font-size:13px;margin:8px 0 4px;">
    <tr>
        <th align="left" style="padding:8px 6px;border-bottom:2px solid #e2e8f0;color:#64748b;font-size:11px;text-transform:uppercase;">Product</th>
        <th align="center" style="padding:8px 6px;border-bottom:2px solid #e2e8f0;color:#64748b;font-size:11px;text-transform:uppercase;">Qty</th>
        <th align="right" style="padding:8px 6px;border-bottom:2px solid #e2e8f0;color:#64748b;font-size:11px;text-transform:uppercase;">Total</th>
    </tr>
    @foreach ($rows as $row)
        <tr>
            <td style="padding:8px 6px;border-bottom:1px solid #f1f5f9;">{{ $row['name'] }}</td>
            <td align="center" style="padding:8px 6px;border-bottom:1px solid #f1f5f9;">{{ $row['qty'] }}</td>
            <td align="right" style="padding:8px 6px;border-bottom:1px solid #f1f5f9;">{{ $row['total'] }}</td>
        </tr>
    @endforeach
    @foreach ($discounts as $d)
        <tr>
            <td colspan="2" style="padding:6px;color:#047857;">{{ $d['name'] }}</td>
            <td align="right" style="padding:6px;color:#047857;">&minus;{{ $d['amount'] }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="2" style="padding:6px;color:#64748b;">Delivery</td>
        <td align="right" style="padding:6px;color:#64748b;">{{ $shipping }}</td>
    </tr>
    <tr>
        <td colspan="2" style="padding:10px 6px;border-top:2px solid #e2e8f0;font-weight:bold;font-size:14px;">Total</td>
        <td align="right" style="padding:10px 6px;border-top:2px solid #e2e8f0;font-weight:bold;font-size:14px;color:#002b5c;">{{ $total }}</td>
    </tr>
</table>
