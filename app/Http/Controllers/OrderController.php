<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function store()
    {
        $cart = session()->get('cart', []);

        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Le panier est vide');
        }

        // Créer la commande
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => array_reduce($cart, function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0),
            'status' => 'pending'
        ]);

        // Créer les OrderItems
        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price']
            ]);
        }

        // Vider le panier
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Commande passée avec succès !');
    }
}
