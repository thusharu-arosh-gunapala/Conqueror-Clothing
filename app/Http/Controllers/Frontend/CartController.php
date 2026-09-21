<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $settings = WebsiteSetting::getSetting();
        $total = $this->calculateTotal($cart);

        return view('frontend.cart.index', compact('cart', 'settings', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $rules = [];
        if (!empty(json_decode($product->sizes, true))) {
            $rules['size'] = 'required|string';
        }
        if (!empty(json_decode($product->colors, true))) {
            $rules['color'] = 'required|string';
        }

        if (!empty($rules)) {
            $request->validate($rules);
        }

        // Validate stock
        if ($product->stock_quantity < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock available',
            ]);
        }

        $cart = session('cart', []);

        // Create unique key for this product variant
        $cartKey = $this->generateCartKey($request->product_id, $request->size, $request->color);

        if (isset($cart[$cartKey])) {
            $newQty = $cart[$cartKey]['quantity'] + $request->quantity;
            if ($product->stock_quantity < $newQty) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient stock for this quantity',
                ]);
            }
            $cart[$cartKey]['quantity'] = $newQty;
        } else {
            $displayPrice = $product->discount_price ?? $product->price;
            $cart[$cartKey] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_code' => $product->product_code,
                'price' => $displayPrice,
                'size' => $request->input('size', ''),
                'color' => $request->input('color', ''),
                'quantity' => $request->quantity,
                'main_image' => $product->main_image,
            ];
        }

        session(['cart' => $cart]);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart',
            'cartCount' => $this->getCartCount($cart),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'cart_key' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session('cart', []);

        if (!isset($cart[$request->cart_key])) {
            return response()->json(['success' => false, 'message' => 'Item not found in cart']);
        }

        $product = Product::find($cart[$request->cart_key]['product_id']);

        if ($product->stock_quantity < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock available',
            ]);
        }

        $cart[$request->cart_key]['quantity'] = $request->quantity;
        session(['cart' => $cart]);

        return response()->json([
            'success' => true,
            'message' => 'Quantity updated',
            'total' => $this->calculateTotal($cart),
        ]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'cart_key' => 'required|string',
        ]);

        $cart = session('cart', []);

        unset($cart[$request->cart_key]);
        session(['cart' => $cart]);

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart',
            'cartCount' => $this->getCartCount($cart),
            'total' => $this->calculateTotal($cart),
        ]);
    }

    public function clear()
    {
        session(['cart' => []]);

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared',
        ]);
    }

    // Helper methods
    private function generateCartKey($productId, $size, $color)
    {
        return md5($productId . '-' . $size . '-' . $color);
    }

    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    private function getCartCount($cart)
    {
        return count($cart);
    }
}
