@extends('emails.layout', ['title' => "Order Received - {$ref}", 'badge' => 'Order Received'])

@section('content')
    <h1 style="margin:0 0 6px;font-size:20px;color:#002b5c;">Thank you for your order, {{ $customerName }}</h1>
    <p style="margin:0 0 20px;">We've received your order <strong>{{ $ref }}</strong>. To complete it, please make a bank transfer using the details below.</p>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:6px;margin:0 0 22px;">
        <tr><td style="padding:16px 18px;font-size:13px;">
            <div style="font-weight:bold;color:#002b5c;font-size:14px;margin-bottom:8px;">Bank Transfer Details</div>
            <table role="presentation" cellpadding="0" cellspacing="0" style="font-size:13px;">
                <tr><td style="padding:3px 18px 3px 0;color:#64748b;">Amount</td><td style="font-weight:bold;">{{ $total }}</td></tr>
                <tr><td style="padding:3px 18px 3px 0;color:#64748b;">Account Name</td><td style="font-weight:bold;">{{ $bank['name'] }}</td></tr>
                <tr><td style="padding:3px 18px 3px 0;color:#64748b;">Sort Code</td><td style="font-weight:bold;">{{ $bank['sortCode'] }}</td></tr>
                <tr><td style="padding:3px 18px 3px 0;color:#64748b;">Account Number</td><td style="font-weight:bold;">{{ $bank['account'] }}</td></tr>
                <tr><td style="padding:3px 18px 3px 0;color:#64748b;">Payment Reference</td><td style="font-weight:bold;color:#b45309;">{{ $ref }}</td></tr>
            </table>
            <div style="margin-top:10px;font-size:12px;color:#b45309;">Please use <strong>{{ $ref }}</strong> as the payment reference so we can match your payment.</div>
        </td></tr>
    </table>

    <div style="font-weight:bold;color:#002b5c;font-size:14px;">Order Summary</div>
    @include('emails._order-table')

    <div style="font-weight:bold;color:#002b5c;font-size:14px;margin-top:20px;">Delivery Address</div>
    <p style="margin:4px 0 0;">{{ $address }}</p>

    @if ($comments)
        <div style="font-weight:bold;color:#002b5c;font-size:14px;margin-top:20px;">Your Comments</div>
        <p style="margin:4px 0 0;white-space:pre-line;">{{ $comments }}</p>
    @endif

    <p style="margin:24px 0 0;">Your order will be dispatched within 2&ndash;3 working days of payment being received.</p>
    @if ($adminEmail)
        <p style="margin:8px 0 0;">Questions? Contact us at <a href="mailto:{{ $adminEmail }}" style="color:#0052a3;">{{ $adminEmail }}</a>.</p>
    @endif
    <p style="margin:16px 0 0;">Thank you,<br><strong>Research-Chem</strong></p>
@endsection
