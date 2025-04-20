<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderDetailResource\Pages;
use App\Models\OrderDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class OrderDetailResource extends Resource
{
    protected static ?string $model = OrderDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-percent';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('order_id')
                ->relationship('order', 'id')
                ->required()
                ->label('Order #'),

            Select::make('product_id')
                ->relationship('product', 'name')
                ->required()
                ->label('Product'),

            TextInput::make('quantity')->numeric()->required(),
            TextInput::make('price')->numeric()->required(),
            TextInput::make('shipping_cost')->numeric()->default(0),
            TextInput::make('tax')->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('order.id')->label('Order #'),
            TextColumn::make('product.name')->label('Product'),
            TextColumn::make('quantity'),
            TextColumn::make('price')->money('IDR'),
            TextColumn::make('shipping_cost')->money('IDR'),
            TextColumn::make('tax')->money('IDR'),
            TextColumn::make('subtotal')
                ->label('Subtotal')
                ->getStateUsing(fn ($record) =>
                    ($record->price * $record->quantity) + $record->shipping_cost + $record->tax
                )
                ->money('IDR'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderDetails::route('/'),
            'create' => Pages\CreateOrderDetail::route('/create'),
            'edit' => Pages\EditOrderDetail::route('/{record}/edit'),
        ];
    }
}
