<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Helpers\PaymentManagement;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Order;
use App\Models\Order_Item;
use App\Models\CouponCode;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Checkout Page - FR3ON GYM')]
class CheckoutPage extends Component
{
    public $first_name, $last_name, $phone, $street_address, $city, $state, $zip_code, $payment_method;

    // Coupon
    public $coupon_code;
    public $coupon_discount = 0;
    public $coupon_applied = false;
    public $invalid_coupon = false;
    public $applied_coupon = null;

    public function mount()
    {
        if (empty(CartManagement::getCartItems())) {
            return redirect()->route('products');
        }
    }

    public function applyCoupon()
    {
        $coupon = CouponCode::where('name', $this->coupon_code)
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('starts_at')->orWhereDate('starts_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhereDate('expires_at', '>=', now());
            })
            ->where(function ($q) {
                $q->whereNull('usage_limit')->orWhereColumn('used_count', '<', 'usage_limit');
            })
            ->first();

        if ($coupon) {
            $this->coupon_discount = $coupon->discount_percentage;
            $this->coupon_applied = true;
            $this->invalid_coupon = false;
            $this->applied_coupon = $coupon;
        } else {
            $this->coupon_discount = 0;
            $this->coupon_applied = false;
            $this->invalid_coupon = true;
            $this->applied_coupon = null;
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

        // ✅ تحقق من المخزون
        foreach ($cart_items as $item) {
            $product = Product::find($item['product_id']);
            if (!$product || $product->stock < $item['quantity']) {
                $this->addError('stock_error', "Product '{$product->name}' is out of stock or insufficient quantity.");
                return; // وقف العملية
            }
        }

        $grand_total = CartManagement::calculateTotalPrice($cart_items);

        if ($this->coupon_applied && $this->coupon_discount > 0) {
            $discount = ($grand_total * $this->coupon_discount) / 100;
            $grand_total -= $discount;
        }

        $order = new Order();
        $order->user_id = Auth::id();
        $order->grand_total = $grand_total;
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->currency = 'EGP';
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';
        $order->notes = 'Order placed by ' . Auth::user()->name;
        $order->save();

        Address::create([
            'order_id' => $order->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'street_address' => $this->street_address,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
        ]);

        foreach ($cart_items as $item) {
            $product = Product::find($item['product_id']);

            // ✅ خصم الكمية من المخزون
            $product->decrement('stock', $item['quantity']);

            Order_Item::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_amount' => $item['unit_amount'],
                'total_amount' => $item['total_amount'],
            ]);
        }

        // Update coupon usage
        if ($this->coupon_applied && $this->applied_coupon) {
            $this->applied_coupon->increment('used_count');
        }

        CartManagement::clearCartItems();

        if (in_array($this->payment_method, ['card', 'wallet'])) {
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
            $redirect_url = $payment->generatePaymentLink($billing, $order->grand_total * 100, $this->payment_method, $order->id);
            return redirect()->to($redirect_url);
        }

        Mail::to(Auth::user())->send(new OrderPlaced($order));
        return redirect()->route('payment.success');
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItems();
        $grand_total = CartManagement::calculateTotalPrice($cart_items);

        if ($this->coupon_applied && $this->coupon_discount > 0) {
            $discount = ($grand_total * $this->coupon_discount) / 100;
            $grand_total -= $discount;
        }

        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total,
        ]);
    }
}
