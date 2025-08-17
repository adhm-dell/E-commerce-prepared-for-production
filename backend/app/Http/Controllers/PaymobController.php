<?php

namespace App\Http\Controllers;

use App\Helpers\CartManagement;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Order;
use App\Models\Order_Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymobController extends Controller
{



    public function handleCallback(Request $request)
    {
        $data = $request->all();
        // save this data at database
        Log::info('Paymob Callback Received:', $data);

        $hmac = $data['hmac'] ?? '';

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
            $concatenatedString .= array_key_exists($field, $data) ? $data[$field] : '';
        }

        $calculatedHmac = hash_hmac('sha512', $concatenatedString, env('PAYMOB_HMAC_SECRET'));

        if (!hash_equals($calculatedHmac, $hmac)) {
            Log::warning('❌ Invalid HMAC from Paymob');
            return redirect()->route('payment.failed');
        }

        $order = Order::where('id', $data['merchant_order_id'])->firstOrFail();

        ###production###//
        if ($data['success'] === "true" && $data['is_refunded'] === "false") {
            Log::info("✅ Payment confirmed for order {$data['order']}");
            $order->payment_status = 'paid';
            $order->save();
            Mail::to(request()->user())->send(new OrderPlaced($order));
            return redirect()->route('payment.success');
        } else {
            $order->payment_status = 'failed';
            $order->status = 'cancelled';
            $order->save();

            // 🔄 Restore product stock
            foreach ($order->items as $item) {
                $product = $item->product;
                if ($product) {
                    $product->stock += $item->quantity; // Restore stock
                    $product->save();
                }
            }

            Log::info("❌ Payment rejected or incomplete for order {$data['order']}");
            return redirect()->route('payment.failed');
        }


        //###testing###//
        // if (($data['data_message'] ?? '') === 'Approved') {
        //     Log::info("✅ Approved by data_message for order {$data['order']}");


        //     // Retrieve order and address from cookies
        //     $orderJson = Cookie::get('order_data');
        //     $addressJson = Cookie::get('address_data');

        //     if ($orderJson && $addressJson) {
        //         $orderData = json_decode($orderJson, true);
        //         $addressData = json_decode($addressJson, true);

        //         // Save order
        //         $order = new Order($orderData);
        //         $order->payment_status = 'paid';
        //         $order->status = 'processing';
        //         $order->save();

        //         // Save address
        //         $address = new Address($addressData);
        //         $address->order_id = $order->id;
        //         $address->save();

        //         // make cart items
        //         $cart_items = CartManagement::getCartItems();
        //         foreach ($cart_items as &$item) {
        //             Order_Item::create([
        //                 'order_id'     => $order->id,
        //                 'product_id'   => $item['product_id'],
        //                 'quantity'     => $item['quantity'],
        //                 'unit_amount'  => $item['unit_amount'],
        //                 'total_amount' => $item['total_amount'],
        //             ]);
        //         }
        //         Cookie::queue(Cookie::forget('order_data'));
        //         Cookie::queue(Cookie::forget('address_data'));
        //         CartManagement::clearCartItems();
        //         Mail::to(request()->user())->send(new OrderPlaced($order));
        //         return redirect()->route('payment.success');
        //     }
        // } else {
        //     Cookie::queue(Cookie::forget('order_data'));
        //     Cookie::queue(Cookie::forget('address_data'));
        //     Log::info("❌ Rejected by data_message: {$data['data_message']} for order {$data['order']}");
        //     return redirect()->route('payment.failed');
        // }
    }
}
