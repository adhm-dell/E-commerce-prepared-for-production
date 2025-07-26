<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('My Orders - FR3ON GYM')]
class MyOrdersPage extends Component
{
    use WithPagination;
    public function render()
    {
        $my_orders = Order::where('user_id', Auth::user()->id)->latest()->paginate(4);
        return view('livewire.my-orders-page', ['my_orders' => $my_orders]);
    }
}
