@extends('emails.layout', ['title' => "New Order {$ref}", 'badge' => 'New Order'])

@section('content')
    <h1 style="margin:0 0 6px;font-size:20px;color:#002b5c;">New bank-transfer order: {{ $ref }}</h1>
    <p style="margin:0 0 20px;">Placed {{ $placedAt }}. Awaiting payment of <strong>{{ $total }}</strong>.</p>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:6px;margin:0 0 22px;">
        <tr><td style="padding:16px 18px;font-size:13px;">
            <table role="presentation" cellpadding="0" cellspacing="0" style="font-size:13px;">
                <tr><td style="padding:3px 18px 3px 0;color:#64748b;">Customer</td><td style="font-weight:bold;">{{ $customerName }}</td></tr>
                <tr><td style="padding:3px 18px 3px 0;color:#64748b;">Email</td><td><a href="mailto:{{ $customerEmail }}" style="color:#0052a3;">{{ $customerEmail }}</a></td></tr>
                <tr><td style="padding:3px 18px 3px 0;color:#64748b;vertical-align:top;">Address</td><td>{{ $address }}</td></tr>
                <tr><td style="padding:3px 18px 3px 0;color:#64748b;">Reference</td><td style="font-weight:bold;">{{ $ref }}</td></tr>
            </table>
        </td></tr>
    </table>

    <div style="font-weight:bold;color:#002b5c;font-size:14px;">Items</div>
    @include('emails._order-table')

    @if ($comments)
        <div style="font-weight:bold;color:#002b5c;font-size:14px;margin-top:20px;">Customer Comments</div>
        <p style="margin:4px 0 0;white-space:pre-line;">{{ $comments }}</p>
    @endif

    @if ($adminUrl)
        <p style="margin:24px 0 0;"><a href="{{ $adminUrl }}" style="display:inline-block;background:#0052a3;color:#ffffff;text-decoration:none;font-weight:bold;font-size:13px;padding:10px 18px;border-radius:5px;">View Orders in Admin</a></p>
    @endif
@endsection
