<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\SmtpSetting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{

    // smtp 

    public function smtpSettings()
    {
        $smtp = SmtpSetting::first();
        return view('admin.smtp_settings', compact('smtp'));
    }

    public function updateSmtpSettings(Request $request)
    {
        $request->validate([
            'mailer' => 'required',
            'host' => 'required',
            'port' => 'required|integer',
            'username' => 'required',
            'password' => 'required',
            'encryption' => 'nullable',
            'from_address' => 'required|email',
            'from_name' => 'required',
        ]);

        // Ensure that only one record exists
        $smtp = SmtpSetting::updateOrCreate(
            ['id' => 1],
            $request->only(['mailer', 'host', 'port', 'username', 'password', 'encryption', 'from_address', 'from_name'])
        );

        // Update .env file
        $this->updateEnv([
            'MAIL_MAILER' => $smtp->mailer,
            'MAIL_HOST' => $smtp->host,
            'MAIL_PORT' => $smtp->port,
            'MAIL_USERNAME' => $smtp->username,
            'MAIL_PASSWORD' => $smtp->password,
            'MAIL_ENCRYPTION' => $smtp->encryption,
            'MAIL_FROM_ADDRESS' => $smtp->from_address,
            'MAIL_FROM_NAME' => $smtp->from_name,
        ]);

        // Config clear
        // Artisan::call('config:clear');

        return redirect()->back()->with('success', 'SMTP settings updated successfully!');
    }

    private function updateEnv($data)
    {
        $envPath = base_path('.env');
        $envContent = file_get_contents($envPath);

        foreach ($data as $key => $value) {
            $envContent = preg_replace("/^{$key}=.*/m", "{$key}=\"{$value}\"", $envContent);
        }

        file_put_contents($envPath, $envContent);
    }



    public function testSmtp(Request $request)
    {
        $request->validate([
            'test_email' => 'required|email',
        ]);

        try {
            Mail::raw('This is a test email to verify SMTP settings.', function ($message) use ($request) {
                $message->to($request->test_email)
                    ->subject('SMTP Test Email');
            });

            return back()->with('success', 'Test email sent successfully! Please check your inbox.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send test email. Error: ' . $e->getMessage());
        }
    }
}
