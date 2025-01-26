<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

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

    /**
     * Initiate Payment
     */
    public function initiatePayment()
    {
        $order = Order::find(Session::get('order_id'));
        $amount = $order->grand_total + $order->shipping_cost - $order->coupon_discount;

        $token = $this->getToken();

        $response = Http::withToken($token)->post($this->base_url . 'checkout/create', [
            'amount' => $amount,
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => "Inv" . Date('YmdH') . rand(1000, 10000),
        ]);
        $result = $response->json();

        if (isset($result['bkashURL'])) {
            return redirect($result['bkashURL']);
        }

        return back()->with('error', 'Payment initiation failed.');
    }

    /**
     * Execute Payment
     */
    public function executePayment(Request $request)
    {
        $paymentID = $request->paymentID;
        $token = $this->getToken();

        $response = Http::withToken($token)->post($this->base_url . 'checkout/execute', [
            'paymentID' => $paymentID,
        ]);

        $result = $response->json();

        if (isset($result['transactionStatus'])) {
            if ($result['transactionStatus'] === 'Completed') {
                return (new OrderController())->checkout_done()->with(['error' => 'Bkash Payment Done']);
            } elseif ($result['transactionStatus'] === 'Failed') {
                return (new OrderController())->checkout_fail()->with(['error' => 'Bkash Payment Failed']);
            }
        }

        return (new OrderController())->checkout_fail()->with(['error' => 'Bkash Payment Canceled']);
    }

    /**
     * Get Authentication Token
     */
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
