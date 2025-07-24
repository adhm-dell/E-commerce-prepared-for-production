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

        // ✨ احصل على الحقول بالترتيب الصحيح:
        $hmacFields = [
            'amount_cents',
            'created_at',
            'currency',
            'error_occured',
            'has_parent_transaction',
            'id',
            'integration_id',
            'is_3d_secure',
            'is_auth',
            'is_capture',
            'is_refunded',
            'is_standalone_payment',
            'is_voided',
            'order',
            'owner',
            'pending',
            'source_data_pan',
            'source_data_sub_type',
            'source_data_type',
            'success'
        ];

        $concatenatedString = '';
        foreach ($hmacFields as $field) {
            $concatenatedString .= $data[$field] ?? '';
        }

        $calculatedHmac = hash_hmac('sha512', $concatenatedString, env('PAYMOB_HMAC_SECRET'));

        if (!hash_equals($calculatedHmac, $hmac)) {
            Log::warning('Invalid HMAC from Paymob');
            return redirect()->route('payment.failed');
        }

        if ($data['success']) {
            Log::info("✅ Payment successful for order {$data['order']}");
            return redirect()->route('payment.success');
        } else {
            Log::info("❌ Payment failed for order {$data['order']}");
            return redirect()->route('payment.failed');
        }
    }
}
