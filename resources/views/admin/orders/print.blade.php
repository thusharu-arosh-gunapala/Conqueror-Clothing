<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->order_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff;
            color: #111;
            margin: 0;
            padding: 24px;
            line-height: 1.45;
        }
        .invoice-actions {
            max-width: 900px;
            margin: 0 auto 14px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        .btn {
            display: inline-block;
            border: 1px solid #111;
            background: #111;
            color: #fff;
            padding: 10px 14px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }
        .btn:hover {
            background: #333;
        }
        .invoice-wrap {
            max-width: 900px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 24px;
        }
        .row {
            display: flex;
            gap: 24px;
            margin-bottom: 20px;
        }
        .col {
            flex: 1;
            min-width: 0;
        }
        h2, h3, h4, h5 {
            margin: 0 0 10px;
        }
        p {
            margin: 0 0 6px;
        }
        hr {
            border: 0;
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
            vertical-align: top;
        }
        th {
            background: #f7f7f7;
            text-align: left;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .totals {
            width: 360px;
            margin-left: auto;
            margin-top: 16px;
            border: 1px solid #ddd;
            padding: 14px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .grand-total {
            font-size: 22px;
            font-weight: 700;
        }
        @media (max-width: 768px) {
            .row { flex-direction: column; }
            .totals { width: 100%; }
        }
        @media print {
            body { padding: 0; }
            .invoice-actions { display: none; }
            .invoice-wrap {
                border: none;
                max-width: 100%;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-actions">
        <button type="button" class="btn" onclick="window.print()">Print Invoice</button>
    </div>

    <div class="invoice-wrap">
        <div class="row">
            <div class="col">
                <h3>{{ $settings?->business_name ?? 'CONQUEROR' }}</h3>
                <p><strong>Email:</strong> {{ $settings?->email ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $settings?->phone_number ?? 'N/A' }}</p>
            </div>
            <div class="col text-right">
                <h4>INVOICE</h4>
                <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
                <p><strong>Time:</strong> {{ $order->created_at->format('H:i A') }}</p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col">
                <h5>Customer Information</h5>
                <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                @if($order->customer_email)
                    <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                @endif
            </div>
            <div class="col">
                <h5>Delivery Address</h5>
                <p>{{ $order->delivery_address }}</p>
                <p><strong>City:</strong> {{ $order->city }}</p>
            </div>
        </div>

        <hr>

        <h5>Order Items</h5>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Code</th>
                    <th>Size/Color</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->product_code }}</td>
                        <td>
                            @if($item->size || $item->color)
                                @if($item->size) {{ $item->size }} @endif
                                @if($item->color) / {{ $item->color }} @endif
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-right">{{ currency_lkr($item->price) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <div class="total-row">
                <span>Subtotal:</span>
                <span>{{ currency_lkr($order->total_amount) }}</span>
            </div>
            <div class="total-row">
                <span>Shipping:</span>
                <span>Free</span>
            </div>
            <div class="total-row">
                <span>Tax:</span>
                <span>{{ currency_lkr(0) }}</span>
            </div>
            <hr>
            <div class="total-row grand-total">
                <span>Total:</span>
                <span>{{ currency_lkr($order->total_amount) }}</span>
            </div>
        </div>
    </div>
</body>
</html>
