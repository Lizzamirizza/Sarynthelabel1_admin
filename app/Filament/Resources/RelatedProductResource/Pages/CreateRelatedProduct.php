<?php

namespace App\Filament\Resources\RelatedProductResource\Pages;

use App\Filament\Resources\RelatedProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRelatedProduct extends CreateRecord
{
    protected static string $resource = RelatedProductResource::class;
}
