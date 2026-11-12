@extends('emails.layout', [
    'title' => 'New Enquiry',
    'badge' => 'New Enquiry',
    'preheader' => "New enquiry: {$subject} from " . ($name ?: $email) . "."
])

@section('content')
    <h1 style="margin:0 0 6px;font-size:20px;font-weight:bold;color:#002b5c;">New contact form enquiry</h1>
    <p style="margin:0 0 20px;color:#334155;font-size:14px;">Received on {{ $receivedAt }}.</p>

    <!-- Sender Details -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;margin:0 0 22px;overflow:hidden;">
        <tr>
            <td style="padding:16px 20px;">
                <div style="font-weight:bold;color:#002b5c;font-size:13px;margin-bottom:10px;text-transform:uppercase;letter-spacing:0.3px;">Sender Details</div>
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="font-size:13px;width:100%;">
                    <tr>
                        <td style="padding:4px 16px 4px 0;color:#64748b;width:100px;">Name</td>
                        <td style="padding:4px 0;font-weight:600;color:#0f172a;">{{ $name ?: 'Not provided' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:4px 16px 4px 0;color:#64748b;">Email</td>
                        <td style="padding:4px 0;"><a href="mailto:{{ $email }}" style="color:#0052a3;text-decoration:none;font-weight:600;">{{ $email }}</a></td>
                    </tr>
                    <tr>
                        <td style="padding:4px 16px 4px 0;color:#64748b;">Phone</td>
                        <td style="padding:4px 0;color:#0f172a;">{{ $phone ?: 'Not provided' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:4px 16px 4px 0;color:#64748b;">Subject</td>
                        <td style="padding:4px 0;font-weight:600;color:#002b5c;">{{ $subject }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Enquiry Message -->
    <div style="font-weight:bold;color:#002b5c;font-size:13px;text-transform:uppercase;letter-spacing:0.3px;">Message Content</div>
    <div style="margin:8px 0 0;padding:16px 18px;border-left:4px solid #0052a3;background-color:#f8fafc;border-radius:0 6px 6px 0;border-top:1px solid #e2e8f0;border-right:1px solid #e2e8f0;border-bottom:1px solid #e2e8f0;color:#334155;font-size:13px;line-height:1.6;">
        {!! nl2br(e($enquiry)) !!}
    </div>

    <!-- Actions -->
    <div style="margin:26px 0 0;">
        <table role="presentation" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td style="padding-right:12px;">
                    <a href="mailto:{{ $email }}?subject={{ rawurlencode('Re: ' . $subject) }}" style="display:inline-block;background-color:#0052a3;color:#ffffff;text-decoration:none;font-weight:bold;font-size:13px;padding:10px 20px;border-radius:5px;">
                        Reply to {{ $name ?: $email }} &rarr;
                    </a>
                </td>
                @if ($adminUrl)
                    <td>
                        <a href="{{ $adminUrl }}" target="_blank" style="display:inline-block;background-color:#ffffff;color:#0052a3;border:1px solid #0052a3;text-decoration:none;font-weight:bold;font-size:13px;padding:9px 18px;border-radius:5px;">
                            View in Admin
                        </a>
                    </td>
                @endif
            </tr>
        </table>
    </div>
@endsection
