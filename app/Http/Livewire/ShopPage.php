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

    //組件創建時被呼叫
    public function mount()
    {
        $this->items = Item::get();
        $order = Order::create(['user_id' => 1]);
        session(['order' => $order]);
    }

    //渲染組件視圖
    public function render()
    {
        return view('livewire.shop-page');
    }

    //Livewire行動，於前端超連結被點下時呼叫，$id為商品ID
    public function addCart($id)
    {
        Log::debug('addCart');
        $order = session()->get('order');
        $this->order = Order::with('items')->findOrFail($order->id);
        $item = Item::findOrFail($id);
        $order->items()->save($item, ['qty' => 1]);
        $this->order = Order::with('items')->findOrFail($order->id);
    }
}
