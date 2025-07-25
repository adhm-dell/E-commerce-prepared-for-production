<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement
{
    // add item to cart
    static public function addItemToCart($product_id)
    {
        $cart_items = self::getCartItems();
        $existing_item = null;

        // Check if the item already exists in the cart
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            // If item exists, increment the quantity
            $cart_items[$existing_item]['quantity'] += 1;
            $cart_items[$existing_item]['total_amount'] =
                $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        } else {
            // If item does not exist, add it to the cart
            $product = Product::where('id', $product_id)->first([
                'id',
                'name',
                'price',
                'image',
            ]);

            if ($product) {
                $cart_items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'unit_amount' => $product->price,
                    'image' => $product->image[0] ?? $product->name, // Assuming image is array
                    'quantity' => 1,
                    'total_amount' => $product->price,
                ];
            }
        }

        // Save the updated cart to cookies
        self::addCartItemstoCookie($cart_items);

        return count($cart_items); // Return the number of items in the cart
    }

    // add item to cart with quntity
    static public function addItemToCartWithQty($product_id, $qty = 1)
    {
        $cart_items = self::getCartItems();
        $existing_item = null;

        // Check if the item already exists in the cart
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            // If item exists, increment the quantity
            $cart_items[$existing_item]['quantity'] += $qty;
            $cart_items[$existing_item]['total_amount'] =
                $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        } else {
            // If item does not exist, add it to the cart
            $product = Product::where('id', $product_id)->first([
                'id',
                'name',
                'price',
                'image',
            ]);

            if ($product) {
                $cart_items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'unit_amount' => $product->price,
                    'image' => $product->image[0] ?? $product->name, // Assuming image is array
                    'quantity' => $qty,
                    'total_amount' => $product->price,
                ];
            }
        }

        // Save the updated cart to cookies
        self::addCartItemstoCookie($cart_items);

        return count($cart_items); // Return the number of items in the cart
    }


    // remove item from cart
    static public function removeItemFromCart($product_id)
    {
        $cart_items = self::getCartItems();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart_items[$key]);
                break;
            }
        }

        // Reindex the array to avoid issues with Livewire wire:key
        $cart_items = array_values($cart_items);

        self::addCartItemstoCookie($cart_items);

        return $cart_items;
    }


    // add cart items to cookie
    static public function addCartItemstoCookie($cart_items)
    {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30); // Store for 30 days
    }

    // clear cart items from cookie
    static public function clearCartItems()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    // get all cart items from cookie
    static public function getCartItems()
    {
        $cart_items = Cookie::get('cart_items');
        return $cart_items ? json_decode($cart_items, true) : [];
    }

    // increment item quantity in cart
    static public function incrementItemQuantity($product_id)
    {
        $cart_items = self::getCartItems();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart_items[$key]['quantity'] += 1;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
            }
        }
        self::addCartItemstoCookie($cart_items);
        return $cart_items; // Return updated cart items
    }

    // decrement item quantity in cart
    static public function decrementItemQuantity($product_id)
    {
        $cart_items = self::getCartItems();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                if ($cart_items[$key]['quantity'] > 1) {
                    $cart_items[$key]['quantity'] -= 1;
                    $cart_items[$key]['total_amount'] =
                        $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                } else {
                    unset($cart_items[$key]); // Remove item if quantity is 1
                }
                break;
            }
        }

        $cart_items = array_values($cart_items); // Reindex keys
        self::addCartItemstoCookie($cart_items);

        return $cart_items;
    }


    // calculate total price of cart items
    static public function calculateTotalPrice($items)
    {
        return array_sum(array_column($items, 'total_amount'));
    }
}
