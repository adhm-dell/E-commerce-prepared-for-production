<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            OrderResource\Widgets\OrderStats::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('ALL'),
            'new' => Tab::make()->query(fn($query) => $query->statusFilter('new'))
                ->label('New'),
            'processing' => Tab::make()->query(fn($query) => $query->statusFilter('processing'))
                ->label('Processing'),
            'shipped' => Tab::make()->query(fn($query) => $query->statusFilter('shipped'))
                ->label('Shipped'),
            'delivered' => Tab::make()->query(fn($query) => $query->statusFilter('delivered'))
                ->label('delivered'),
            'cancelled' => Tab::make()->query(fn($query) => $query->statusFilter('cancelled'))
                ->label('Cancelled'),
        ];
    }
}
