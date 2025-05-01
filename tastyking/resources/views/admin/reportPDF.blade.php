<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TastyKing - Admin Report</title>
</head>
<body>
    <div class="header">
        <div class="logo">TastyKing</div>
        <div class="report-title">Administrative Report</div>
        <div class="report-date">Generated on: {{ $date }}</div>
    </div>

    <div class="stats-container">
        <table class="stats-table">
            <tr>
                <td class="stat-cell">
                    <span class="stat-title">Total Orders:</span>
                    <span class="stat-value">{{ $totalOrders }}</span>
                </td>
                <td class="stat-cell">
                    <span class="stat-title">Total Revenue:</span>
                    <span class="stat-value">{{ number_format($totalRevenue, 2) }} dh</span>
                </td>
            </tr>
            <tr>
                <td class="stat-cell">
                    <span class="stat-title">Total Users:</span>
                    <span class="stat-value">{{ $totalUsers }}</span>
                    <span class="stat-info">({{ $active }}% active)</span>
                </td>
                <td class="stat-cell">
                    <span class="stat-title">Total Menu Items:</span>
                    <span class="stat-value">{{ $totalMeals }}</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="section-title">Weekly Revenue</div>
    <table>
        <thead>
            <tr>
                @foreach($weeklyRevenueData['labels'] as $day)
                    <th>{{ $day }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach($weeklyRevenueData['revenues'] as $revenue)
                    <td>{{ number_format($revenue, 2) }} dh</td>
                @endforeach
            </tr>
        </tbody>
    </table>

    <div class="section-title">Popular Items</div>
    <table class="popular-items-table">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Price</th>
                <th>Order Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach($popularItems as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->price, 2) }} dh</td>
                    <td>{{ $item->order_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>This is an automatically generated report from TastyKing's administrative dashboard.</p>
        <p>For any questions or concerns, please contact the system administrator.</p>
    </div>
</body>
</html>


 <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 15px;
            color: #333;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 1px solid #F17228;
            padding-bottom: 10px;
        }
        .logo {
            font-size: 20px;
            font-weight: bold;
            color: #F17228;
        }
        .report-title {
            font-size: 16px;
            margin-top: 5px;
        }
        .report-date {
            font-size: 12px;
            color: #666;
            margin-top: 3px;
        }
        .stats-container {
            margin-bottom: 20px;
        }
        .stats-table {
            width: 100%;
            border-collapse: collapse;
        }
        .stat-cell {
            padding: 10px;
            background-color: #FFF8DC;
            border: 1px solid #eee;
        }
        .stat-title {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin-right: 10px;
        }
        .stat-value {
            font-size: 16px;
            font-weight: bold;
            color: #F17228;
        }
        .stat-info {
            font-size: 12px;
            color: #666;
            margin-left: 5px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin: 15px 0 8px 0;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 3px;
        }
        .popular-items-table {
            margin-bottom: 15px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 6px;
            text-align: center;
            font-size: 12px;
        }
        th {
            background-color: #f2f2f2;
            font-size: 12px;
        }
</style>