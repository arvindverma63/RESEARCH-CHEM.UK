@extends('emails.layout', [
    'title' => "Order Received - {$ref}",
    'badge' => 'Order Received',
    'preheader' => "Thank you for your order ({$ref}). Please find bank transfer payment details inside."
])

@section('content')
    <h1 style="margin:0 0 8px;font-size:20px;font-weight:bold;color:#002b5c;line-height:1.3;">Thank you for your order, {{ $customerName }}</h1>
    <p style="margin:0 0 20px;color:#334155;font-size:14px;">
        We have received your order <strong style="color:#002b5c;">{{ $ref }}</strong>. To complete your purchase and release the package for dispatch, please make a UK bank transfer using the details below:
    </p>

    <!-- Bank Transfer Details Card -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f0f7ff;border:1px solid #bfdbfe;border-radius:8px;margin:0 0 24px;overflow:hidden;">
        <tr>
            <td style="padding:18px 20px;">
                <div style="font-weight:bold;color:#002b5c;font-size:14px;margin-bottom:12px;letter-spacing:0.3px;text-transform:uppercase;">
                    Bank Transfer Details
                </div>
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="font-size:13px;width:100%;">
                    <tr>
                        <td style="padding:5px 16px 5px 0;color:#64748b;width:130px;vertical-align:middle;">Amount to Transfer</td>
                        <td style="padding:5px 0;vertical-align:middle;">
                            <span style="font-size:17px;font-weight:bold;color:#002b5c;">{{ $total }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:5px 16px 5px 0;color:#64748b;vertical-align:middle;">Account Name</td>
                        <td style="padding:5px 0;font-weight:bold;color:#0f172a;vertical-align:middle;">{{ $bank['name'] }}</td>
                    </tr>
                    <tr>
                        <td style="padding:5px 16px 5px 0;color:#64748b;vertical-align:middle;">Sort Code</td>
                        <td style="padding:5px 0;vertical-align:middle;">
                            <code style="font-family:Consolas, 'Courier New', monospace;font-size:14px;font-weight:bold;background:#ffffff;border:1px solid #cbd5e1;padding:2px 8px;border-radius:4px;color:#0f172a;">{{ $bank['sortCode'] }}</code>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:5px 16px 5px 0;color:#64748b;vertical-align:middle;">Account Number</td>
                        <td style="padding:5px 0;vertical-align:middle;">
                            <code style="font-family:Consolas, 'Courier New', monospace;font-size:14px;font-weight:bold;background:#ffffff;border:1px solid #cbd5e1;padding:2px 8px;border-radius:4px;color:#0f172a;">{{ $bank['account'] }}</code>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:7px 16px 5px 0;color:#64748b;vertical-align:middle;">Payment Reference</td>
                        <td style="padding:7px 0 5px;vertical-align:middle;">
                            <code style="display:inline-block;font-family:Consolas, 'Courier New', monospace;font-size:15px;font-weight:bold;background:#fef3c7;border:1px solid #fde68a;color:#92400e;padding:3px 10px;border-radius:4px;letter-spacing:0.5px;">{{ $ref }}</code>
                        </td>
                    </tr>
                </table>
                <div style="margin-top:14px;padding:10px 12px;background:#fffbeb;border:1px solid #fde68a;border-radius:6px;font-size:12px;line-height:1.5;color:#92400e;">
                    <strong>Important:</strong> Please ensure you enter <strong style="color:#78350f;">{{ $ref }}</strong> as your payment reference so our system can automatically match and approve your payment without delay.
                </div>
            </td>
        </tr>
    </table>

    <!-- Order Items Summary -->
    <div style="font-weight:bold;color:#002b5c;font-size:14px;letter-spacing:0.3px;text-transform:uppercase;">Order Summary</div>
    @include('emails._order-table')

    <!-- Delivery Address -->
    <div style="font-weight:bold;color:#002b5c;font-size:14px;margin-top:22px;letter-spacing:0.3px;text-transform:uppercase;">Delivery Address</div>
    <div style="margin:6px 0 0;padding:12px 14px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:6px;line-height:1.6;color:#334155;font-size:13px;">
        {!! nl2br(e($address)) !!}
    </div>

    @if ($comments)
        <div style="font-weight:bold;color:#002b5c;font-size:14px;margin-top:18px;letter-spacing:0.3px;text-transform:uppercase;">Order Notes</div>
        <div style="margin:6px 0 0;padding:12px 14px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:6px;line-height:1.6;color:#334155;font-size:13px;">
            {!! nl2br(e($comments)) !!}
        </div>
    @endif

    <!-- Dispatch Banner -->
    <div style="margin:22px 0 0;padding:12px 16px;background:#ecfdf5;border:1px solid #a7f3d0;border-radius:6px;color:#065f46;font-size:13px;line-height:1.5;">
        <strong>📦 Next-Day Dispatch:</strong> Your order will be <strong>shipped next working day</strong> via tracked delivery once your payment has been confirmed.
    </div>

    @if ($adminEmail)
        <p style="margin:20px 0 0;font-size:13px;color:#475569;">
            Questions about your order? Reply directly to this email or contact us at <a href="mailto:{{ $adminEmail }}" style="color:#0052a3;font-weight:600;text-decoration:none;">{{ $adminEmail }}</a>.
        </p>
    @endif

    <p style="margin:18px 0 0;color:#0f172a;font-size:14px;">
        Thank you for choosing Research-Chem UK.<br>
        <strong>Research-Chem Laboratory Supply</strong>
    </p>
@endsection
