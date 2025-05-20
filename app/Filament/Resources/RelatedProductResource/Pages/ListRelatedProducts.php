<?php

namespace App\Filament\Resources\RelatedProductResource\Pages;

use App\Filament\Resources\RelatedProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRelatedProducts extends ListRecords
{
    protected static string $resource = RelatedProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
