<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title ?? 'Research-Chem' }}</title>
</head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:Arial,Helvetica,sans-serif;color:#0f172a;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f1f5f9;padding:24px 12px;">
<tr><td align="center">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;background:#ffffff;border-radius:8px;overflow:hidden;border:1px solid #e2e8f0;">
        <tr>
            <td style="background:#002b5c;padding:20px 28px;">
                <span style="color:#ffffff;font-size:20px;font-weight:bold;letter-spacing:0.5px;">Research-Chem</span>
                @isset($badge)
                    <span style="float:right;background:#0052a3;color:#ffffff;font-size:11px;font-weight:bold;padding:4px 10px;border-radius:4px;text-transform:uppercase;letter-spacing:0.5px;">{{ $badge }}</span>
                @endisset
            </td>
        </tr>
        <tr>
            <td style="padding:28px;font-size:14px;line-height:1.6;color:#334155;">
                @yield('content')
            </td>
        </tr>
        <tr>
            <td style="background:#f8fafc;border-top:1px solid #e2e8f0;padding:16px 28px;font-size:11px;line-height:1.6;color:#64748b;">
                Research-Chem &middot; <a href="{{ config('app.url') }}" style="color:#0052a3;text-decoration:none;">{{ preg_replace('#^https?://#', '', config('app.url')) }}</a><br>
                All products are supplied for laboratory research use only. Not for human or veterinary use.
            </td>
        </tr>
    </table>
</td></tr>
</table>
</body>
</html>
