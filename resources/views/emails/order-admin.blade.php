@extends('emails.layout', [
    'title' => "New Order {$ref}",
    'badge' => 'New Order',
    'preheader' => "New bank-transfer order {$ref} from {$customerName} ({$total})."
])

@section('content')
    <h1 style="margin:0 0 6px;font-size:20px;font-weight:bold;color:#002b5c;">New bank-transfer order: {{ $ref }}</h1>
    <p style="margin:0 0 20px;color:#334155;font-size:14px;">
        Placed on {{ $placedAt }}. Awaiting bank transfer confirmation of <strong style="color:#002b5c;">{{ $total }}</strong>.
    </p>

    <!-- Customer & Order Meta -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;margin:0 0 24px;overflow:hidden;">
        <tr>
            <td style="padding:16px 20px;">
                <div style="font-weight:bold;color:#002b5c;font-size:13px;margin-bottom:10px;text-transform:uppercase;letter-spacing:0.3px;">Customer &amp; Shipping Details</div>
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="font-size:13px;width:100%;">
                    <tr>
                        <td style="padding:4px 16px 4px 0;color:#64748b;width:120px;">Customer</td>
                        <td style="padding:4px 0;font-weight:600;color:#0f172a;">{{ $customerName }}</td>
                    </tr>
                    <tr>
                        <td style="padding:4px 16px 4px 0;color:#64748b;">Email</td>
                        <td style="padding:4px 0;"><a href="mailto:{{ $customerEmail }}" style="color:#0052a3;text-decoration:none;font-weight:600;">{{ $customerEmail }}</a></td>
                    </tr>
                    @if (!empty($customerPhone))
                        <tr>
                            <td style="padding:4px 16px 4px 0;color:#64748b;">Phone</td>
                            <td style="padding:4px 0;color:#0f172a;">{{ $customerPhone }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td style="padding:4px 16px 4px 0;color:#64748b;vertical-align:top;">Address</td>
                        <td style="padding:4px 0;color:#334155;line-height:1.5;">{!! nl2br(e($address)) !!}</td>
                    </tr>
                    <tr>
                        <td style="padding:4px 16px 4px 0;color:#64748b;">Payment Ref</td>
                        <td style="padding:4px 0;">
                            <code style="font-family:Consolas, 'Courier New', monospace;font-weight:bold;background:#ffffff;border:1px solid #cbd5e1;padding:2px 8px;border-radius:4px;color:#0f172a;">{{ $ref }}</code>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Order Items -->
    <div style="font-weight:bold;color:#002b5c;font-size:14px;letter-spacing:0.3px;text-transform:uppercase;">Order Items</div>
    @include('emails._order-table')

    @if ($comments)
        <div style="font-weight:bold;color:#002b5c;font-size:14px;margin-top:20px;letter-spacing:0.3px;text-transform:uppercase;">Customer Comments</div>
        <div style="margin:6px 0 0;padding:12px 14px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:6px;font-size:13px;line-height:1.6;color:#334155;">
            {!! nl2br(e($comments)) !!}
        </div>
    @endif

    @if ($adminUrl)
        <div style="margin:26px 0 0;">
            <a href="{{ $adminUrl }}" target="_blank" style="display:inline-block;background-color:#0052a3;color:#ffffff;text-decoration:none;font-weight:bold;font-size:13px;padding:11px 22px;border-radius:6px;letter-spacing:0.3px;">
                View Order in Admin &rarr;
            </a>
        </div>
    @endif
@endsection
