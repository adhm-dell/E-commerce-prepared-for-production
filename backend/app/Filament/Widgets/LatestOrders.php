<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('Order ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.name')->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'new' => 'info',
                        'processing' => 'warning',
                        'shipped' => 'success',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'new' => 'heroicon-m-sparkles',
                        'processing' => 'heroicon-m-arrow-path',
                        'shipped' => 'heroicon-o-truck',
                        'delivered' => 'heroicon-o-check-badge',
                        'cancelled' => 'heroicon-m-x-circle',
                    })
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'paid' => 'success',
                        'failed' => 'danger',
                        'pending' => 'warning',
                    })
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('grand_total')
                    ->label('Total Amount')
                    ->money('EGP')
                    ->sortable()
                    ->searchable(),
            ])
            ->actions([
                Action::make('View Order')
                    ->icon('heroicon-o-eye')
                    ->url(fn(Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
                    ->openUrlInNewTab()
                    ->color('info'),
            ]);
    }
}
