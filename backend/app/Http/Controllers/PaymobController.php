<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymobController extends Controller
{
    public function handleCallback(Request $request)
    {
        $data = $request->all();
        Log::info('Paymob Callback Received:', $data);

        $hmac = $data['hmac'] ?? '';
        unset($data['hmac']);

        ksort($data);
        $concatenated = implode('', $data);
        $calculatedHmac = hash_hmac('sha512', $concatenated, env('PAYMOB_HMAC_SECRET'));

        if (!hash_equals($calculatedHmac, $hmac)) {
            Log::warning('Invalid HMAC from Paymob');
            return redirect()->route('payment.failed');
        }

        if ($data['success']) {
            // ✅ You can update your order here (optional)
            Log::info("Payment successful for order {$data['order']}");
            return redirect()->route('payment.success');
        } else {
            Log::info("Payment failed for order {$data['order']}");
            return redirect()->route('payment.failed');
        }
    }
}
