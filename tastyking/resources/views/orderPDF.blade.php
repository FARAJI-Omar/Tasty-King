<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} - TastyKing</title>
</head>

<body>
    <div class="header">
        <div class="logo">TastyKing</div>
        <p>Order Receipt</p>
    </div>

    <div class="order-info">
        <p><strong>Order #:</strong> {{ $order->id }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('F d, Y - g:i A') }}</p>
        <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
        <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
        @if($order->delivery_message)
            <p><strong>Delivery Message:</strong> {{ $order->delivery_message }}</p>
        @endif
    </div>

    <h3>Order Items</h3>
    <table class="order-details">
        <thead>
            <tr>
                <th>Item</th>
                <th>Size</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $items = json_decode($order->items_data);
                $subtotal = 0;
            @endphp

            @foreach($items as $item)
                <tr>
                    <td>{{ $item->meal_name }}</td>
                    <td>{{ $item->size }}</td>
                    <td>{{ number_format($item->meal_price, 2) }} dh</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->subtotal, 2) }} dh</td>
                </tr>
                @php
                    $subtotal += $item->subtotal;
                @endphp
            @endforeach

            <tr>
                <td colspan="4" style="text-align: right;"><strong>Subtotal:</strong></td>
                <td>{{ number_format($subtotal, 2) }} dh</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Delivery Fee:</strong></td>
                <td>20.00 dh</td>
            </tr>
            <tr class="total-row">
                <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
                <td>{{ number_format($order->total, 2) }} dh</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Thank you for ordering from TastyKing!</p>
        <p>For any questions or concerns, please contact us at support@tastyking.com</p>
    </div>
</body>
</html>


 <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #F17228;
        }
        .order-info {
            margin-bottom: 20px;
        }
        .order-info p {
            margin: 5px 0;
        }
        .order-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .order-details th, .order-details td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .order-details th {
            background-color: #f2f2f2;
        }
        .total-row {
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>