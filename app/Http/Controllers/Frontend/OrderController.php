<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty');
        }

        $total = $this->calculateTotal($cart);
        $settings = WebsiteSetting::getSetting();

        return view('frontend.orders.checkout', compact('cart', 'total', 'settings'));
    }

    public function place(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty');
        }

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email',
            'customer_whatsapp' => 'nullable|string|max:20',
            'delivery_address' => 'required|string',
            'city' => 'required|string|max:100',
            'order_notes' => 'nullable|string',
        ]);

        // Create order
        $order = new Order();
        $order->order_number = $order->generateOrderNumber();
        $order->customer_name = $request->customer_name;
        $order->customer_phone = $request->customer_phone;
        $order->customer_email = $request->customer_email;
        $order->customer_whatsapp = $request->customer_whatsapp;
        $order->delivery_address = $request->delivery_address;
        $order->city = $request->city;
        $order->order_notes = $request->order_notes;
        $order->total_amount = $this->calculateTotal($cart);
        $order->payment_method = 'Cash on Delivery';
        $order->status = 'New';
        $order->save();

        // Add order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_code' => $item['product_code'],
                'product_name' => $item['product_name'],
                'product_image' => $item['main_image'],
                'size' => $item['size'],
                'color' => $item['color'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);

            // Reduce stock
            $product = Product::find($item['product_id']);
            if ($product) {
                $product->stock_quantity -= $item['quantity'];
                $product->save();
            }
        }

        // Clear cart
        session(['cart' => []]);

        return redirect()->route('orders.success', ['order_number' => $order->order_number]);
    }

    public function success($order_number)
    {
        $order = Order::where('order_number', $order_number)->firstOrFail();
        $order->load('items');

        $settings = WebsiteSetting::getSetting();

        // Generate WhatsApp message
        $whatsappMessage = $this->generateWhatsAppMessage($order);
        $whatsappLink = $this->generateWhatsAppLink($settings, $whatsappMessage);

        return view('frontend.orders.success', compact('order', 'settings', 'whatsappLink', 'whatsappMessage'));
    }

    // Helper methods
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    private function generateWhatsAppMessage($order)
    {
        $message = "New Cash on Delivery Order\n\n";
        $message .= "Order Number: " . $order->order_number . "\n";
        $message .= "Customer Name: " . $order->customer_name . "\n";
        $message .= "Phone: " . $order->customer_phone . "\n";

        if ($order->customer_whatsapp) {
            $message .= "WhatsApp: " . $order->customer_whatsapp . "\n";
        }

        $message .= "Address: " . $order->delivery_address . "\n";
        $message .= "City/Area: " . $order->city . "\n";
        $message .= "\nOrder Items:\n";

        foreach ($order->items as $index => $item) {
            $message .= ($index + 1) . ". " . $item->product_name . " - Code: " . $item->product_code 
                     . " - Size: " . $item->size . " - Color: " . $item->color 
                     . " - Qty: " . $item->quantity . " - Price: " . $item->price 
                     . " - Subtotal: " . $item->subtotal . "\n";
        }

        $message .= "\nTotal Amount: " . $order->total_amount . "\n";
        $message .= "Payment Method: " . $order->payment_method . "\n";

        if ($order->order_notes) {
            $message .= "Order Notes: " . $order->order_notes . "\n";
        }

        return $message;
    }

    private function generateWhatsAppLink($settings, $message)
    {
        if (!$settings->admin_whatsapp_number) {
            return null;
        }

        // Remove + from WhatsApp number if present (WhatsApp web link doesn't need it)
        $whatsappNumber = str_replace('+', '', $settings->admin_whatsapp_number);
        $encodedMessage = urlencode($message);

        return "https://wa.me/" . $whatsappNumber . "?text=" . $encodedMessage;
    }
}
