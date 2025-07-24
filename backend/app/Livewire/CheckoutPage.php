<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Helpers\PaymentManagement;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

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
        $order->currncy = 'EGP';
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';
        $order->notes = 'Order placed by ' . Auth::user()->name;
        // $order->save();

        $address = new Address();
        $address->order_id = $order->id;
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->zip_code = $this->zip_code;
        // $address->save();

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

            $redirect_url = $payment->generatePaymentLink($billing, $amountCents, $this->payment_method);
            return redirect()->to($redirect_url);
        }

        // else: handle other payment methods
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
