<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{ $title ?? 'Research-Chem' }}</title>
<style type="text/css">
    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
    img { -ms-interpolation-mode: bicubic; border: 0; outline: none; text-decoration: none; }
    body { margin: 0; padding: 0; width: 100% !important; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #0f172a; }
</style>
</head>
<body style="margin:0;padding:0;background-color:#f1f5f9;-webkit-font-smoothing:antialiased;">
@isset($preheader)
<div style="display:none;font-size:1px;color:#f1f5f9;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;">
    {{ $preheader }}
</div>
@endisset

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f1f5f9;padding:24px 12px;">
<tr>
    <td align="center">
        <!-- Main Card Container -->
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;background-color:#ffffff;border-radius:8px;overflow:hidden;border:1px solid #e2e8f0;box-shadow:0 1px 3px rgba(0,0,0,0.06);">
            <!-- Header Banner -->
            <tr>
                <td style="background-color:#002b5c;padding:20px 28px;border-bottom:3px solid #0052a3;">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td align="left" style="vertical-align:middle;">
                                <a href="{{ config('app.url') }}" target="_blank" style="color:#ffffff;text-decoration:none;font-size:20px;font-weight:bold;letter-spacing:0.8px;display:inline-block;font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                    RESEARCH-CHEM<span style="color:#38bdf8;">.UK</span>
                                </a>
                                <div style="color:#93c5fd;font-size:10px;letter-spacing:1px;text-transform:uppercase;margin-top:2px;">Laboratory Research Reagents</div>
                            </td>
                            @isset($badge)
                            <td align="right" style="vertical-align:middle;">
                                <span style="display:inline-block;background-color:#0052a3;color:#ffffff;font-size:11px;font-weight:bold;padding:5px 12px;border-radius:4px;text-transform:uppercase;letter-spacing:0.5px;white-space:nowrap;">
                                    {{ $badge }}
                                </span>
                            </td>
                            @endisset
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- Content Body -->
            <tr>
                <td style="padding:28px 30px;font-size:14px;line-height:1.65;color:#334155;">
                    @yield('content')
                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td style="background-color:#f8fafc;border-top:1px solid #e2e8f0;padding:20px 28px;font-size:11px;line-height:1.6;color:#64748b;">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding-bottom:10px;border-bottom:1px solid #e2e8f0;color:#0f172a;font-weight:600;font-size:12px;">
                                RESEARCH-CHEM.UK &middot; <a href="{{ config('app.url') }}" target="_blank" style="color:#0052a3;text-decoration:none;">{{ rtrim(preg_replace('#^https?://#', '', config('app.url')), '/') }}</a>
                                @if (config('mail.admin_address'))
                                    &middot; <a href="mailto:{{ config('mail.admin_address') }}" style="color:#0052a3;text-decoration:none;">{{ config('mail.admin_address') }}</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top:10px;font-size:11px;color:#64748b;line-height:1.5;">
                                <strong>FOR LABORATORY RESEARCH USE ONLY.</strong> Strictly intended for in-vitro research, development, and laboratory analytical testing. Not for human or veterinary use, consumption, or therapeutic application.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
</table>
</body>
</html>
