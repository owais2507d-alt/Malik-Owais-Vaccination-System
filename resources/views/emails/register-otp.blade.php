<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your VaxPortal OTP Code</title>
    <style>
        /* Email client cross-platform smooth text compatibility rendering */
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
        }
    </style>
</head>
<body style="background-color: #f8fafc; padding: 40px 16px;">
    <div style="max-width: 520px; margin: 0 auto; background-color: #ffffff; border-radius: 24px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02); overflow: hidden; border: 1px solid #e2e8f0;">

        <div style="background: linear-gradient(135deg, #0e7490 0%, #115e59 50%, #075985 100%); padding: 40px 32px; text-align: center; position: relative;">
            <div style="display: inline-flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                <span style="font-size: 32px; vertical-align: middle;">🩺</span>
                <span style="font-size: 24px; font-weight: 800; color: #ffffff; letter-spacing: -1px; font-family: 'Plus Jakarta Sans', sans-serif;">VAXPORTAL</span>
            </div>
            <p style="color: #c5f2f7; font-size: 11px; font-weight: 700; tracking: 2px; margin: 0; letter-spacing: 0.15em;">VACCINATION MANAGEMENT SYSTEM</p>
        </div>

        <div style="padding: 40px 32px;">
            <h2 style="font-size: 22px; font-weight: 700; color: #1e293b; margin-top: 0; margin-bottom: 12px;">
                Hello {{ $name }},
            </h2>
            
            <p style="font-size: 15px; line-height: 1.6; color: #64748b; margin-top: 0; margin-bottom: 32px;">
                Thank you for onboarding with <strong>VaxPortal</strong>. To guarantee the highest layer of healthcare data protection, please verify your identity container by utilizing the secure 6-digit verification sequence detailed below:
            </p>

            <div style="background-color: #f8fafc; border: 2px dashed #0bc5ea; border-radius: 20px; padding: 32px 24px; text-align: center; margin-bottom: 32px;">
                <p style="color: #0891b2; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; margin-top: 0; margin-bottom: 16px;">One-Time Verification Token</p>
                
                <div style="font-size: 42px; font-weight: 800; letter-spacing: 12px; color: #0f172a; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; background-color: #ffffff; padding: 18px 12px; border-radius: 14px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); display: block; text-indent: 12px;">
                    {{ $otp }}
                </div>
                
                <p style="color: #ef4444; font-size: 13px; font-weight: 600; margin-top: 18px; margin-bottom: 0; display: inline-flex; align-items: center; gap: 6px;">
                    ⏱️ Valid for exactly 2 minutes
                </p>
            </div>

            <div style="background-color: #fff1f2; border: 1px solid #ffe4e6; border-radius: 16px; padding: 16px; margin-bottom: 32px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td style="vertical-align: top; font-size: 18px; width: 28px; padding-top: 2px;">⚠️</td>
                        <td style="font-size: 13.5px; line-height: 1.5; color: #9f1239;">
                            <strong>Security Protocol Reminder:</strong> VaxPortal staff will never request this access identifier under any standard phone operations or verification sequences. If you did not initialize this command query, please safely ignore this transaction ledger.
                        </td>
                    </tr>
                </table>
            </div>

            <div style="text-align: center; margin-top: 12px;">
                <a href="{{ route('register.otp.view') }}" 
                   style="display: inline-block; background: linear-gradient(135deg, #0891b2 0%, #0d9488 100%); color: #ffffff; font-weight: 600; font-size: 15px; text-decoration: none; padding: 16px 36px; border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(8, 145, 178, 0.3); transition: all 0.2s ease;">
                    Proceed to Verification Terminal →
                </a>
            </div>
        </div>

        <div style="background-color: #f8fafc; border-t: 1px solid #f1f5f9; padding: 32px; text-align: center;">
            <p style="color: #94a3b8; font-size: 13px; font-weight: 500; margin-top: 0; margin-bottom: 6px;">
                VaxPortal Network Operations Admin Desk
            </p>
            <p style="color: #94a3b8; font-size: 11px; margin: 0; line-height: 1.6;">
                © {{ date('Y') }} VaxPortal Platform. All rights reserved.<br>
                This transactional system diagnostic dispatch is automated. Do not reply.
            </p>
        </div>
    </div>
</body>
</html>