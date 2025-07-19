<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
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

        // Here you would typically handle the order placement logic,
        // such as saving the order to the database, processing payment, etc.

        session()->flash('message', 'Order placed successfully!');
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItems();
        $garnd_total = CartManagement::calculateTotalPrice($cart_items);
        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $garnd_total,
        ]);
    }
}
