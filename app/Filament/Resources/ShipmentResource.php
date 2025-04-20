<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShipmentResource\Pages;
use App\Models\Shipment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;


class ShipmentResource extends Resource
{
    protected static ?string $model = Shipment::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('order_id')
                ->relationship('order', 'id')
                ->searchable()
                ->required()
                ->label('Order #'),

            TextInput::make('courier')
                ->required()
                ->maxLength(255),

            TextInput::make('tracking_number')
                ->maxLength(255)
                ->nullable(),

            Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'shipped' => 'Shipped',
                    'delivered' => 'Delivered',
                    'cancelled' => 'Cancelled',
                ])
                ->required(),

            Textarea::make('address')
                ->required()
                ->rows(3),

            DateTimePicker::make('estimated_delivery')->nullable(),
            DateTimePicker::make('shipped_at')->nullable(),
            DateTimePicker::make('delivered_at')->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order.id')->label('Order #'),
                TextColumn::make('courier'),
                TextColumn::make('tracking_number')->label('Tracking No.')->wrap(),
                BadgeColumn::make('status')->colors([
                    'gray' => 'pending',
                    'warning' => 'shipped',
                    'success' => 'delivered',
                    'danger' => 'cancelled',
                ]),
                TextColumn::make('estimated_delivery')->label('ETA')->dateTime(),
                TextColumn::make('shipped_at')->label('Shipped')->dateTime(),
                TextColumn::make('delivered_at')->label('Delivered')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShipments::route('/'),
            'create' => Pages\CreateShipment::route('/create'),
            'edit' => Pages\EditShipment::route('/{record}/edit'),
        ];
    }
}
