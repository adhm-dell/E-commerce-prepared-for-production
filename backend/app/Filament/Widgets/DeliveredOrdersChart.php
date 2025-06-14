<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class DeliveredOrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Delivered Orders (Daily - Last 7 Days)';
    protected static ?int $sort = 1;

    protected function getData(): array
    {
        // Get last 7 days
        $startDate = now()->subDays(6)->startOfDay();
        $endDate = now()->endOfDay();

        $data = Order::query()
            ->selectRaw("DATE(created_at) as day, COUNT(*) as total")
            ->where('status', 'delivered')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('total', 'day')
            ->toArray();

        // Fill in days with 0 if there’s no data
        $labels = [];
        $values = [];

        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            $day = $date->toDateString(); // e.g. 2025-06-14
            $labels[] = $day;
            $values[] = $data[$day] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Delivered Orders',
                    'data' => $values,
                    'borderColor' => 'rgba(34, 197, 94, 1)',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.2)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line'; // or 'bar'
    }
}
