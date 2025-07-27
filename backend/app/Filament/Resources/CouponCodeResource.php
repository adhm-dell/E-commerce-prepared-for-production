<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponCodeResource\Pages;
use App\Filament\Resources\CouponCodeResource\RelationManagers;
use App\Models\CouponCode;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CouponCodeResource extends Resource
{
    protected static ?string $model = CouponCode::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('discount_percentage')
                    ->numeric()
                    ->required(),

                Forms\Components\Toggle::make('is_active'),

                Forms\Components\TextInput::make('usage_limit')
                    ->numeric()
                    ->nullable(),

                Forms\Components\TextInput::make('used_count')
                    ->numeric()
                    ->default(0)
                    ->disabled(),

                Forms\Components\DateTimePicker::make('starts_at')->nullable(),
                Forms\Components\DateTimePicker::make('expires_at')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('discount_percentage'),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('usage_limit'),
                Tables\Columns\TextColumn::make('used_count'),
                Tables\Columns\TextColumn::make('starts_at')->dateTime(),
                Tables\Columns\TextColumn::make('expires_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCouponCodes::route('/'),
            'create' => Pages\CreateCouponCode::route('/create'),
            'edit' => Pages\EditCouponCode::route('/{record}/edit'),
        ];
    }
}
