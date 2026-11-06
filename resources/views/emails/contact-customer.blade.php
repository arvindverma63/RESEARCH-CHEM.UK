@extends('emails.layout', ['title' => 'We received your enquiry', 'badge' => 'Enquiry Received'])

@section('content')
    <h1 style="margin:0 0 6px;font-size:20px;color:#002b5c;">Thanks for getting in touch{{ $name ? ', ' . $name : '' }}</h1>
    <p style="margin:0 0 20px;">We've received your enquiry and a member of our team will respond shortly, usually within one working day.</p>

    <div style="font-weight:bold;color:#002b5c;font-size:14px;">Your message</div>
    <div style="margin:6px 0 0;padding:14px 16px;border-left:3px solid #0052a3;background:#f8fafc;">
        <div style="font-weight:bold;margin-bottom:6px;">{{ $subject }}</div>
        <div style="white-space:pre-line;">{{ $enquiry }}</div>
    </div>

    <p style="margin:24px 0 0;">Thank you,<br><strong>Research-Chem</strong></p>
@endsection
