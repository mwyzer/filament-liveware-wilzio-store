<?php

namespace App\Livewire\Web\Cart;

use App\Models\Cart;
use Livewire\Component;

class BtnDecrement extends Component
{
    public $cart_id;
    public $product_id;
    public $disabled;
    
    /**
     * mount
     *
     * @param  mixed $cart_id
     * @param  mixed $product_id
     * @return void
     */
    public function mount($cart_id, $product_id)
    {
        $this->cart_id = $cart_id;
        $this->product_id = $product_id;
    }
    
    /**
     * decrement
     *
     * @return void
     */
    public function decrement()
    {
        $cart = Cart::find($this->cart_id);

        if ($cart) {
            $cart->decrement('qty');
    
            // Check if quantity is zero after decrement
            if ($cart->qty <= 0) {
                $cart->delete();
                session()->flash('success', 'Produk berhasil dihapus dari keranjang');
            } else {
                session()->flash('success', 'Qty keranjang berhasil dikurangi');
            }
        } else {
            session()->flash('error', 'Keranjang tidak ditemukan');
        }
    
        // Redirect
        return $this->redirect('/cart', navigate: true);
    }

    public function render()
    {
        return view('livewire.web.cart.btn-decrement');
    }
}