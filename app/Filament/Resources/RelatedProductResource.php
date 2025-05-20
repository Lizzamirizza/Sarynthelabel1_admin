<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RelatedProductResource\Pages;
use App\Models\RelatedProduct;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextArea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class RelatedProductResource extends Resource
{
    protected static ?string $model = RelatedProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Name for the related product
            TextInput::make('name')->required()->maxLength(255),

            // Price for the related product
            TextInput::make('price')->numeric()->required(),

            // Stock for the related product
            TextInput::make('stock')->numeric()->required()->min(0), // Ensure the stock value is a positive number

            // File upload for the related product image
            FileUpload::make('image')
                ->directory('related_products') // Specify the folder in public/storage
                ->image()
                ->disk('public') // Use public disk
                ->nullable(), 

            // Select the product this related product belongs to
            Select::make('product_id')
                ->label('Product') // The label will be "Product"
                ->relationship('product', 'name') // The related field is 'name' from the Product model
                ->required()
                ->searchable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->searchable(),
            TextColumn::make('price')->money('IDR'),
            TextColumn::make('stock')->label('Stock'), // Display stock quantity
            ImageColumn::make('image')
                ->label('Image')
                ->disk('public')
                ->height(50), // Adjust the height of the image displayed in the table
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRelatedProducts::route('/'),
            'create' => Pages\CreateRelatedProduct::route('/create'),
            'edit' => Pages\EditRelatedProduct::route('/{record}/edit'),
        ];
    }
}
