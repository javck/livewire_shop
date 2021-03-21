<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Order;
use Log;

class ShopPage extends Component
{
    public $items;
    public Order $order;
    public $order_items = [];

    public function mount()
    {
        $this->items = Item::get();
        $order = Order::create(['user_id'=>1]);
        session(['order'=>$order]);
    }

    public function hydrate()
    {
        Log::debug('hydrate');
        // $order = session()->get('order');
        // Log::debug($order);
        // $this->order = Order::with('items')->findOrFail($order->id);
        // $this->order_items = $this->order->items;
        // Log::debug($this->order_items);
    }

    public function render()
    {
        return view('livewire.shop-page');
    }

    public function addCart($id)
    {
        Log::debug('addCart');
        $order = session()->get('order');
        $this->order = Order::with('items')->findOrFail($order->id);
        $item = Item::findOrFail($id);
        $order->items()->save($item, ['qty' => 1]);
        $this->order = Order::with('items')->findOrFail($order->id);
        $this->order_items = $order->items;
    }
}
