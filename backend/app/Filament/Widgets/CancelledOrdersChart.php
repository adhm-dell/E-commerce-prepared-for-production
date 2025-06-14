<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class CancelledOrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Cancelled Orders (Daily - Last 7 Days)';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $startDate = now()->subDays(6)->startOfDay();
        $endDate = now()->endOfDay();

        $data = Order::query()
            ->selectRaw("DATE(created_at) as day, COUNT(*) as total")
            ->where('status', 'cancelled')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('total', 'day')
            ->toArray();

        $labels = [];
        $values = [];

        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            $day = $date->toDateString();
            $labels[] = $day;
            $values[] = $data[$day] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Cancelled Orders',
                    'data' => $values,
                    'borderColor' => 'rgba(239, 68, 68, 1)',       // Tailwind red-500
                    'backgroundColor' => 'rgba(239, 68, 68, 0.2)', // red-500 with opacity
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
