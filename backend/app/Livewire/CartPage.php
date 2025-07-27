<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Cart - FR3ON GYM')]
class CartPage extends Component
{

    public $cartItems = [];
    public $grand_total = 0;

    public function mount()
    {
        // Initialize cart items and grand total
        CartManagement::refreshCartDiscounts(); // Ensure updated prices
        $this->cartItems = CartManagement::getCartItems();
        $this->grand_total = CartManagement::calculateTotalPrice($this->cartItems);
    }

    public function removeItem($itemId)
    {
        $this->cartItems = CartManagement::removeItemFromCart($itemId);
        $this->grand_total = CartManagement::calculateTotalPrice($this->cartItems);
        $this->dispatch('update-cart-count', total_count: count($this->cartItems))->to(Navbar::class);
    }

    public function decrementQuantity($product_id)
    {
        $this->cartItems = CartManagement::decrementItemQuantity($product_id);
        $this->grand_total = CartManagement::calculateTotalPrice($this->cartItems);
        $this->dispatch('update-cart-count', total_count: count($this->cartItems))->to(Navbar::class);
    }
    public function incrementQuantity($product_id)
    {
        $this->cartItems = CartManagement::incrementItemQuantity($product_id);
        $this->grand_total = CartManagement::calculateTotalPrice($this->cartItems);
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
