<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Helpers\PaymentManagement;
use App\Http\Controllers\PaymobController;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Order;
use App\Models\Order_Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;
use Paymob\Library\Paymob;

#[Title('Checkout Page - FR3ON GYM')]
class CheckoutPage extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $city;
    public $state;
    public $zip_code;
    public $payment_method;

    public function mount()
    {
        $cart_items = CartManagement::getCartItems();
        if (empty($cart_items)) {
            return redirect()->route('products');
        }
    }

    public function placeOrder()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'payment_method' => 'required',
        ]);

        $cart_items = CartManagement::getCartItems();

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->grand_total = CartManagement::calculateTotalPrice($cart_items);
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->currency = 'EGP';
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';
        $order->notes = 'Order placed by ' . Auth::user()->name;

        $address = new Address();
        $address->order_id = $order->id;
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->zip_code = $this->zip_code;

        $order->save();
        // Save address
        $address->order_id = $order->id;
        $address->save();

        // Save order items
        foreach ($cart_items as $item) {
            Order_Item::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_amount' => $item['unit_amount'],
                'total_amount' => $item['total_amount'],
            ]);
        }

        CartManagement::clearCartItems();

        if ($this->payment_method === 'card' || $this->payment_method === 'wallet') {
            $payment = new PaymentManagement();

            $billing = $payment->generateBillingData(
                Auth::user()->email,
                $this->first_name,
                $this->last_name,
                $this->phone,
                $this->street_address,
                $this->city,
                $this->state,
                $this->zip_code
            );

            $amountCents = $order->grand_total * 100;
            $redirect_url = $payment->generatePaymentLink($billing, $amountCents, $this->payment_method, $order->id);

            return redirect()->to($redirect_url);
        } elseif ($this->payment_method === 'cod') {
            // Save order and address directly for Cash on Delivery

            $order->save();

            Mail::to(request()->user())->send(new OrderPlaced($order));

            return redirect()->route('payment.success');
        }
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItems();
        $grand_total = CartManagement::calculateTotalPrice($cart_items);

        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total,
        ]);
    }
}
