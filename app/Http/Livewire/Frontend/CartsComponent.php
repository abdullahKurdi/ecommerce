<?php

namespace App\Http\Livewire\Frontend;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartsComponent extends Component
{
    public $countCart;
    public $countWishlist;

    protected $listeners = [
        'updateCart' => 'update_cart',
    ];

    public function mount(){
        $this->countCart        = Cart::instance('default')->count();
        $this->countWishlist    = Cart::instance('wishlist')->count();
    }

    public function update_cart(){
        $this->countCart        = Cart::instance('default')->count();
        $this->countWishlist    = Cart::instance('wishlist')->count();
    }

    public function render()
    {
        return view('livewire.frontend.carts-component');
    }
}
