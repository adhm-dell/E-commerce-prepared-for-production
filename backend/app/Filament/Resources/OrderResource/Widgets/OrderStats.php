<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use BcMath\Number;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Orders', Order::statusFilter('new')->count()),
            Stat::make('Processing Orders', Order::statusFilter('processing')->count()),
            Stat::make('Shipped Orders', Order::statusFilter('shipped')->count()),
            Stat::make(
                'Total Revenue',
                'EGP ' . number_format((float) Order::query()->sum('grand_total'), 2)
            )
                ->description('Total Income')
                ->color('success'),
        ];
    }
}
