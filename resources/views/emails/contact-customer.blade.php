@extends('emails.layout', [
    'title' => 'We received your enquiry',
    'badge' => 'Enquiry Received',
    'preheader' => "Thank you for contacting Research-Chem UK. We've received your enquiry and will respond shortly."
])

@section('content')
    <h1 style="margin:0 0 8px;font-size:20px;font-weight:bold;color:#002b5c;">Thanks for getting in touch{{ $name ? ', ' . $name : '' }}</h1>
    <p style="margin:0 0 20px;color:#334155;font-size:14px;line-height:1.6;">
        We have received your laboratory research inquiry. A member of our technical support team will review your message and respond shortly, usually within one working day.
    </p>

    <!-- Quoted Enquiry Box -->
    <div style="font-weight:bold;color:#002b5c;font-size:13px;text-transform:uppercase;letter-spacing:0.3px;">Your Enquiry</div>
    <div style="margin:8px 0 0;padding:16px 18px;border-left:4px solid #0052a3;background-color:#f8fafc;border-radius:0 6px 6px 0;border-top:1px solid #e2e8f0;border-right:1px solid #e2e8f0;border-bottom:1px solid #e2e8f0;">
        <div style="font-weight:bold;color:#002b5c;font-size:14px;margin-bottom:8px;">{{ $subject }}</div>
        <div style="color:#334155;font-size:13px;line-height:1.6;">{!! nl2br(e($enquiry)) !!}</div>
    </div>

    <p style="margin:24px 0 0;font-size:14px;color:#0f172a;">
        Best regards,<br>
        <strong>Research-Chem UK Laboratory Team</strong>
    </p>
@endsection
