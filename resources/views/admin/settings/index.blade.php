@extends('admin.layouts.app')

@section('title', 'Admin Settings & Credentials')
@section('page_title', 'Settings')

@section('content')
<div class="space-y-6 max-w-6xl">

    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold tracking-tight text-slate-900 font-heading">
                Admin Settings & Credentials
            </h1>
            <p class="text-xs text-slate-500 mt-0.5">
                Manage your administrator login, password, and email (SMTP) settings.
            </p>
        </div>

        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>Super Administrator Active</span>
        </div>
    </div>

    <!-- Flash Errors (if validation failed) -->
    @if ($errors->any())
        <div class="p-4 rounded-md bg-red-50 border border-red-200 text-red-800 text-xs font-medium space-y-1">
            <div class="flex items-center gap-2 font-bold text-red-900">
                <i data-lucide="alert-circle" class="w-4 h-4 text-red-600 shrink-0"></i>
                <span>Please correct the errors below:</span>
            </div>
            <ul class="list-disc list-inside pl-6 space-y-0.5 text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- ── CARD 1: PROFILE & LOGIN EMAIL ── -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-xs flex flex-col justify-between overflow-hidden">
            <div>
                <!-- Card Header -->
                <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/60">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-md bg-blue-50 border border-blue-200 text-[#0052a3] flex items-center justify-center font-bold">
                            <i data-lucide="user" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900 font-heading">Login Profile & Email</h2>
                            <p class="text-[11px] text-slate-500">Update your name and primary login address</p>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-200">
                        Profile
                    </span>
                </div>

                <!-- Form -->
                <form id="profileForm" action="{{ route('admin.settings.profile') }}" method="POST" class="p-5 space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Display Name -->
                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-700 mb-1 font-heading">
                            Administrator Name <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <i data-lucide="user-check" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   required
                                   placeholder="e.g. Master Administrator"
                                   class="w-full pl-9 pr-3 py-2 text-xs border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 {{ $errors->has('name') ? 'border-red-300 bg-red-50/30' : 'border-slate-300' }}">
                        </div>
                        @error('name')
                            <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 mb-1 font-heading">
                            Login Email Address <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <i data-lucide="mail" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   required
                                   placeholder="admin@research-chem.uk"
                                   class="w-full pl-9 pr-3 py-2 text-xs border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 {{ $errors->has('email') ? 'border-red-300 bg-red-50/30' : 'border-slate-300' }}">
                        </div>
                        <p class="text-slate-500 text-[11px] mt-1">
                            This email address is required to sign into the <strong class="font-medium text-slate-700">/admin/login</strong> portal.
                        </p>
                        @error('email')
                            <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role & Info -->
                    <div class="p-3 bg-slate-50 rounded-md border border-slate-200 text-xs space-y-1 text-slate-600">
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="text-slate-500">Access Privilege:</span>
                            <span class="font-mono font-bold text-emerald-700 bg-emerald-100 px-1.5 py-0.5 rounded">Super Admin</span>
                        </div>
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="text-slate-500">User ID:</span>
                            <span class="font-mono text-slate-700">#{{ $user->id }}</span>
                        </div>
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="text-slate-500">Last Profile Update:</span>
                            <span class="font-mono text-slate-700">{{ $user->updated_at ? $user->updated_at->format('d M Y, H:i') : 'Initial' }}</span>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer Action -->
            <div class="p-4 bg-slate-50 border-t border-slate-100 flex justify-end">
                <button type="submit" form="profileForm"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-[#0052a3] hover:bg-[#004080] text-white text-xs font-bold font-heading rounded-md shadow-xs transition-colors">
                    <i data-lucide="save" class="w-3.5 h-3.5"></i>
                    <span>Save Profile Changes</span>
                </button>
            </div>
        </div>

        <!-- ── CARD 2: PASSWORD CHANGE ── -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-xs flex flex-col justify-between overflow-hidden"
             x-data="{ showCurrent: false, showNew: false, showConfirm: false }">
            <div>
                <!-- Card Header -->
                <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/60">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-md bg-amber-50 border border-amber-200 text-amber-700 flex items-center justify-center font-bold">
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900 font-heading">Security & Password</h2>
                            <p class="text-[11px] text-slate-500">Update your administrator account password</p>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider bg-amber-50 text-amber-800 border border-amber-200">
                        Security
                    </span>
                </div>

                <!-- Form -->
                <form id="passwordForm" action="{{ route('admin.settings.password') }}" method="POST" class="p-5 space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Current Password -->
                    <div>
                        <label for="current_password" class="block text-xs font-bold text-slate-700 mb-1 font-heading">
                            Current Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                            <input :type="showCurrent ? 'text' : 'password'"
                                   id="current_password"
                                   name="current_password"
                                   required
                                   autocomplete="current-password"
                                   placeholder="Enter current password to authorize changes"
                                   class="w-full pl-9 pr-9 py-2 text-xs border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 {{ $errors->has('current_password') ? 'border-red-300 bg-red-50/30' : 'border-slate-300' }}">
                            <button type="button" @click="showCurrent = !showCurrent" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1">
                                <i :data-lucide="showCurrent ? 'eye-off' : 'eye'" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-700 mb-1 font-heading">
                            New Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <i data-lucide="key" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                            <input :type="showNew ? 'text' : 'password'"
                                   id="password"
                                   name="password"
                                   required
                                   autocomplete="new-password"
                                   placeholder="Minimum 8 characters"
                                   class="w-full pl-9 pr-9 py-2 text-xs border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 {{ $errors->has('password') ? 'border-red-300 bg-red-50/30' : 'border-slate-300' }}">
                            <button type="button" @click="showNew = !showNew" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1">
                                <i :data-lucide="showNew ? 'eye-off' : 'eye'" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                        <p class="text-slate-400 text-[11px] mt-1">Use at least 8 characters with a mix of letters, numbers, and symbols.</p>
                        @error('password')
                            <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold text-slate-700 mb-1 font-heading">
                            Confirm New Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <i data-lucide="check-check" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                            <input :type="showConfirm ? 'text' : 'password'"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   required
                                   autocomplete="new-password"
                                   placeholder="Re-type new password"
                                   class="w-full pl-9 pr-9 py-2 text-xs border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 border-slate-300">
                            <button type="button" @click="showConfirm = !showConfirm" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1">
                                <i :data-lucide="showConfirm ? 'eye-off' : 'eye'" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer Action -->
            <div class="p-4 bg-slate-50 border-t border-slate-100 flex justify-end">
                <button type="submit" form="passwordForm"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-slate-900 hover:bg-black text-white text-xs font-bold font-heading rounded-md shadow-xs transition-colors">
                    <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                    <span>Update Password</span>
                </button>
            </div>
        </div>

    </div>

    <!-- ── CARD 3: EMAIL / SMTP SETTINGS ── -->
    <style>[x-cloak]{display:none !important}</style>
    <div class="bg-white rounded-lg border border-slate-200 shadow-xs overflow-hidden"
         x-data="{ showSmtpPass: false, showToken: false, driver: '{{ old('mail_driver', $mail['mailer'] === 'hostinger' ? 'hostinger' : 'smtp') }}' }">
        <!-- Card Header -->
        <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/60">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-md bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center font-bold">
                    <i data-lucide="send" class="w-4 h-4"></i>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-900 font-heading">Email Settings</h2>
                    <p class="text-[11px] text-slate-500">How order and enquiry emails are sent. Saved values override .env.</p>
                </div>
            </div>
            @php
                $active = in_array($mail['mailer'], ['smtp', 'hostinger'], true);
                $badge = ['smtp' => 'SMTP Active', 'hostinger' => 'Hostinger API Active'][$mail['mailer']] ?? 'Mailer: ' . $mail['mailer'];
            @endphp
            <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider {{ $active ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-amber-50 text-amber-800 border border-amber-200' }}">
                {{ $badge }}
            </span>
        </div>

        <form id="mailForm" action="{{ route('admin.settings.mail') }}" method="POST" class="p-5">
            @csrf
            @method('PUT')

            @php
                $input = 'w-full px-3 py-2 text-xs border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600';
                $label = 'block text-xs font-bold text-slate-700 mb-1 font-heading';
            @endphp

            <!-- Driver -->
            <div class="mb-4">
                <label class="{{ $label }}">Sending Method <span class="text-red-500">*</span></label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <label class="flex items-start gap-2 p-3 rounded-md border cursor-pointer text-xs"
                           :class="driver === 'hostinger' ? 'border-emerald-500 bg-emerald-50/50' : 'border-slate-300'">
                        <input type="radio" name="mail_driver" value="hostinger" x-model="driver" class="mt-0.5">
                        <span>
                            <strong class="block text-slate-800">Hostinger Mail API</strong>
                            <span class="text-[11px] text-slate-500">Sends over HTTPS with an API token. Recommended.</span>
                        </span>
                    </label>
                    <label class="flex items-start gap-2 p-3 rounded-md border cursor-pointer text-xs"
                           :class="driver === 'smtp' ? 'border-emerald-500 bg-emerald-50/50' : 'border-slate-300'">
                        <input type="radio" name="mail_driver" value="smtp" x-model="driver" class="mt-0.5">
                        <span>
                            <strong class="block text-slate-800">SMTP</strong>
                            <span class="text-[11px] text-slate-500">Classic mail server login (host, port, password).</span>
                        </span>
                    </label>
                </div>
                @error('mail_driver') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Hostinger API Token -->
                <div class="lg:col-span-2" x-show="driver === 'hostinger'" x-cloak>
                    <label for="hostinger_api_token" class="{{ $label }}">Mail API Token</label>
                    <div class="relative">
                        <input :type="showToken ? 'text' : 'password'" id="hostinger_api_token" name="hostinger_api_token" autocomplete="off"
                               placeholder="{{ $mail['has_api_token'] ? '•••••••• (leave blank to keep)' : 'Paste token from hPanel → Emails → Agentic Mail → API access' }}"
                               class="{{ $input }} pr-9 font-mono {{ $errors->has('hostinger_api_token') ? 'border-red-300 bg-red-50/30' : 'border-slate-300' }}">
                        <button type="button" @click="showToken = !showToken" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1">
                            <i :data-lucide="showToken ? 'eye-off' : 'eye'" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                    <p class="text-slate-400 text-[11px] mt-1">Stored encrypted. Leave blank to keep the current token.</p>
                    @error('hostinger_api_token') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Hostinger Mailbox ID -->
                <div x-show="driver === 'hostinger'" x-cloak>
                    <label for="hostinger_mailbox_id" class="{{ $label }}">Mailbox ID <span class="text-slate-400 font-normal">(optional)</span></label>
                    <input type="text" id="hostinger_mailbox_id" name="hostinger_mailbox_id"
                           value="{{ old('hostinger_mailbox_id', $mail['mailbox_id']) }}" placeholder="Auto-detect"
                           class="{{ $input }} font-mono {{ $errors->has('hostinger_mailbox_id') ? 'border-red-300 bg-red-50/30' : 'border-slate-300' }}">
                    <p class="text-slate-400 text-[11px] mt-1">Leave blank: the mailbox matching the Sender Email is used.</p>
                    @error('hostinger_mailbox_id') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Host -->
                <div class="lg:col-span-2" x-show="driver === 'smtp'" x-cloak>
                    <label for="mail_host" class="{{ $label }}">SMTP Host <span class="text-red-500">*</span></label>
                    <input type="text" id="mail_host" name="mail_host" :required="driver === 'smtp'"
                           value="{{ old('mail_host', $mail['host']) }}" placeholder="smtp.hostinger.com"
                           class="{{ $input }} {{ $errors->has('mail_host') ? 'border-red-300 bg-red-50/30' : 'border-slate-300' }}">
                    @error('mail_host') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Port -->
                <div x-show="driver === 'smtp'" x-cloak>
                    <label for="mail_port" class="{{ $label }}">Port <span class="text-red-500">*</span></label>
                    <input type="number" id="mail_port" name="mail_port" :required="driver === 'smtp'" min="1" max="65535"
                           value="{{ old('mail_port', $mail['port']) }}" placeholder="465"
                           class="{{ $input }} {{ $errors->has('mail_port') ? 'border-red-300 bg-red-50/30' : 'border-slate-300' }}">
                    @error('mail_port') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Username -->
                <div x-show="driver === 'smtp'" x-cloak>
                    <label for="mail_username" class="{{ $label }}">SMTP Username <span class="text-red-500">*</span></label>
                    <input type="text" id="mail_username" name="mail_username" :required="driver === 'smtp'" autocomplete="off"
                           value="{{ old('mail_username', $mail['username']) }}" placeholder="enquiry@yourdomain.com"
                           class="{{ $input }} {{ $errors->has('mail_username') ? 'border-red-300 bg-red-50/30' : 'border-slate-300' }}">
                    @error('mail_username') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Password -->
                <div x-show="driver === 'smtp'" x-cloak>
                    <label for="mail_password" class="{{ $label }}">SMTP Password</label>
                    <div class="relative">
                        <input :type="showSmtpPass ? 'text' : 'password'" id="mail_password" name="mail_password" autocomplete="new-password"
                               placeholder="{{ $mail['has_password'] ? '•••••••• (leave blank to keep)' : 'Enter mailbox password' }}"
                               class="{{ $input }} pr-9 {{ $errors->has('mail_password') ? 'border-red-300 bg-red-50/30' : 'border-slate-300' }}">
                        <button type="button" @click="showSmtpPass = !showSmtpPass" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1">
                            <i :data-lucide="showSmtpPass ? 'eye-off' : 'eye'" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                    <p class="text-slate-400 text-[11px] mt-1">Stored encrypted. Leave blank to keep the current password.</p>
                    @error('mail_password') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Encryption -->
                <div x-show="driver === 'smtp'" x-cloak>
                    <label for="mail_encryption" class="{{ $label }}">Encryption <span class="text-red-500">*</span></label>
                    @php $enc = old('mail_encryption', $mail['encryption']); @endphp
                    <select id="mail_encryption" name="mail_encryption" :required="driver === 'smtp'"
                            class="{{ $input }} bg-white {{ $errors->has('mail_encryption') ? 'border-red-300 bg-red-50/30' : 'border-slate-300' }}">
                        <option value="ssl" @selected($enc === 'ssl')>SSL (usually port 465)</option>
                        <option value="tls" @selected($enc === 'tls')>TLS / STARTTLS (usually port 587)</option>
                        <option value="none" @selected($enc === 'none')>None</option>
                    </select>
                    @error('mail_encryption') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- From Address -->
                <div>
                    <label for="mail_from_address" class="{{ $label }}">Sender Email <span class="text-red-500">*</span></label>
                    <input type="email" id="mail_from_address" name="mail_from_address" required
                           value="{{ old('mail_from_address', $mail['from_address']) }}" placeholder="enquiry@yourdomain.com"
                           class="{{ $input }} {{ $errors->has('mail_from_address') ? 'border-red-300 bg-red-50/30' : 'border-slate-300' }}">
                    <p class="text-slate-400 text-[11px] mt-1">Must be the mailbox you send from (the Hostinger API always sends from the mailbox).</p>
                    @error('mail_from_address') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- From Name -->
                <div>
                    <label for="mail_from_name" class="{{ $label }}">Sender Name <span class="text-red-500">*</span></label>
                    <input type="text" id="mail_from_name" name="mail_from_name" required
                           value="{{ old('mail_from_name', $mail['from_name']) }}" placeholder="Research-Chem"
                           class="{{ $input }} {{ $errors->has('mail_from_name') ? 'border-red-300 bg-red-50/30' : 'border-slate-300' }}">
                    @error('mail_from_name') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Admin Email -->
                <div>
                    <label for="admin_email" class="{{ $label }}">Admin Notification Email <span class="text-red-500">*</span></label>
                    <input type="email" id="admin_email" name="admin_email" required
                           value="{{ old('admin_email', $mail['admin_email']) }}" placeholder="info@yourdomain.com"
                           class="{{ $input }} {{ $errors->has('admin_email') ? 'border-red-300 bg-red-50/30' : 'border-slate-300' }}">
                    <p class="text-slate-400 text-[11px] mt-1">New orders and enquiries are sent here.</p>
                    @error('admin_email') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </form>

        <!-- Footer: Test + Save -->
        <div class="p-4 bg-slate-50 border-t border-slate-100 flex flex-col md:flex-row md:items-start justify-between gap-3">
            <form action="{{ route('admin.settings.mail.test') }}" method="POST" class="flex-1 max-w-xl">
                @csrf
                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="email" name="test_email" required
                           value="{{ old('test_email', $mail['admin_email']) }}" placeholder="Send test to…"
                           class="flex-1 px-3 py-2 text-xs border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 {{ $errors->has('mail_test') || $errors->has('test_email') ? 'border-red-300 bg-red-50/30' : 'border-slate-300' }}">
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-white hover:bg-slate-100 text-slate-800 border border-slate-300 text-xs font-bold font-heading rounded-md shadow-xs transition-colors">
                        <i data-lucide="mail-check" class="w-3.5 h-3.5"></i>
                        <span>Send Test Email</span>
                    </button>
                </div>
                <p class="text-slate-400 text-[11px] mt-1">Uses the saved settings. Save your changes first.</p>
                @error('mail_test') <p class="text-red-600 text-[11px] mt-1 break-all">{{ $message }}</p> @enderror
                @error('test_email') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
            </form>

            <button type="submit" form="mailForm"
                    class="w-full md:w-auto inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold font-heading rounded-md shadow-xs transition-colors">
                <i data-lucide="save" class="w-3.5 h-3.5"></i>
                <span>Save Email Settings</span>
            </button>
        </div>
    </div>

    <!-- ── SECURITY GUIDELINES ── -->
    <div class="p-5 rounded-lg border border-slate-200 bg-white shadow-xs">
        <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider font-heading mb-3 flex items-center gap-2">
            <i data-lucide="info" class="w-4 h-4 text-blue-600"></i>
            <span>Security & Best Practice Guidelines</span>
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs text-slate-600">
            <div class="p-3 bg-slate-50 rounded border border-slate-100">
                <strong class="font-bold text-slate-800 block mb-1">Single Administrator Protection</strong>
                <p class="text-[11px] text-slate-500 leading-relaxed">
                    Changes take effect immediately across all database connections. Ensure your email is accessible to prevent lockout.
                </p>
            </div>
            <div class="p-3 bg-slate-50 rounded border border-slate-100">
                <strong class="font-bold text-slate-800 block mb-1">Strong Cryptographic Hashing</strong>
                <p class="text-[11px] text-slate-500 leading-relaxed">
                    Passwords are encrypted with industry-standard bcrypt. Antigravity never stores or exposes raw password strings.
                </p>
            </div>
            <div class="p-3 bg-slate-50 rounded border border-slate-100">
                <strong class="font-bold text-slate-800 block mb-1">Session Integrity</strong>
                <p class="text-[11px] text-slate-500 leading-relaxed">
                    After updating your credentials, keep your login email and password in a secure password manager.
                </p>
            </div>
        </div>
    </div>

</div>
@endsection

