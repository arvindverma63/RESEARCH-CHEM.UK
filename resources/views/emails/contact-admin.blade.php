@extends('emails.layout', ['title' => 'New Enquiry', 'badge' => 'New Enquiry'])

@section('content')
    <h1 style="margin:0 0 6px;font-size:20px;color:#002b5c;">New contact form enquiry</h1>
    <p style="margin:0 0 20px;">Received {{ $receivedAt }}.</p>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:6px;margin:0 0 22px;">
        <tr><td style="padding:16px 18px;font-size:13px;">
            <table role="presentation" cellpadding="0" cellspacing="0" style="font-size:13px;">
                <tr><td style="padding:3px 18px 3px 0;color:#64748b;">Name</td><td style="font-weight:bold;">{{ $name ?: '-' }}</td></tr>
                <tr><td style="padding:3px 18px 3px 0;color:#64748b;">Email</td><td><a href="mailto:{{ $email }}" style="color:#0052a3;">{{ $email }}</a></td></tr>
                <tr><td style="padding:3px 18px 3px 0;color:#64748b;">Phone</td><td>{{ $phone ?: '-' }}</td></tr>
                <tr><td style="padding:3px 18px 3px 0;color:#64748b;">Subject</td><td style="font-weight:bold;">{{ $subject }}</td></tr>
            </table>
        </td></tr>
    </table>

    <div style="font-weight:bold;color:#002b5c;font-size:14px;">Message</div>
    <div style="margin:6px 0 0;padding:14px 16px;border-left:3px solid #0052a3;background:#f8fafc;white-space:pre-line;">{{ $enquiry }}</div>

    <p style="margin:24px 0 0;">
        <a href="mailto:{{ $email }}?subject={{ rawurlencode('Re: ' . $subject) }}" style="display:inline-block;background:#0052a3;color:#ffffff;text-decoration:none;font-weight:bold;font-size:13px;padding:10px 18px;border-radius:5px;">Reply to {{ $name ?: $email }}</a>
        @if ($adminUrl)
            &nbsp; <a href="{{ $adminUrl }}" style="color:#0052a3;font-size:13px;">View in Admin</a>
        @endif
    </p>
@endsection
