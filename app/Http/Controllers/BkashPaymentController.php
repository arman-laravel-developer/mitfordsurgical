<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BkashPaymentController extends Controller
{
    private $base_url;
    private $app_key;
    private $app_secret;
    private $username;
    private $password;

    public function __construct()
    {
        // Use sandbox credentials for testing
        $setting = GeneralSetting::first();
        if ($setting->sandbox_mode == 1)
        {
            $this->base_url = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized/';
        }
        else
        {
            $this->base_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized/';
        }
        $this->app_key = env('BKASH_APP_KEY');
        $this->app_secret = env('BKASH_APP_SECRET');
        $this->username = env('BKASH_USERNAME');
        $this->password = env('BKASH_PASSWORD');
    }

    public function initiatePayment(Request $request)
    {
        $token = $this->getToken();

        $response = Http::withToken($token)->post($this->base_url . 'checkout/create', [
            'amount' => $request->amount,
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => uniqid(),
        ]);

        $result = $response->json();

        if (isset($result['bkashURL'])) {
            return redirect($result['bkashURL']);
        }

        return back()->with('error', 'Payment initiation failed.');
    }

    public function executePayment(Request $request)
    {
        $paymentID = $request->paymentID;
        $token = $this->getToken();

        $response = Http::withToken($token)->post($this->base_url . 'checkout/execute', [
            'paymentID' => $paymentID,
        ]);

        $result = $response->json();

        if (isset($result['transactionStatus']) && $result['transactionStatus'] === 'Completed') {
            return response()->json(['success' => true, 'data' => $result]);
        }

        return response()->json(['success' => false, 'message' => 'Payment execution failed.']);
    }

    public function callback(Request $request)
    {
        // Handle callback data from bKash if required
        return response()->json(['message' => 'Callback received', 'data' => $request->all()]);
    }

    private function getToken()
    {
        $response = Http::post($this->base_url . 'checkout/token/grant', [
            'app_key' => $this->app_key,
            'app_secret' => $this->app_secret,
        ]);

        $result = $response->json();

        if (isset($result['id_token'])) {
            return $result['id_token'];
        }

        return null;
    }
}
