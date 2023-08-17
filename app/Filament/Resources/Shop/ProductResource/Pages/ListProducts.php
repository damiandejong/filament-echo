<?php

namespace App\Filament\Resources\Shop\ProductResource\Pages;

use App\Filament\Resources\Shop\ProductResource;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = ProductResource::class;

    public function getListeners()
    {
        return [
            'echo:products,.ProductUpdated' => '$refresh'
        ];
    }

    protected function getActions(): array
    {
        return [
            Action::make('test')
                ->label('Send a test notification')
                ->action(function () {
                    Notification::make('test')
                        ->title('This is a test notification')
                        ->success()
                        ->broadcast(auth()->user());
                })
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return ProductResource::getWidgets();
    }
}
