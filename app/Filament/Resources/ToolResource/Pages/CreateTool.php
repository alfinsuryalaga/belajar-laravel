<?php

namespace App\Filament\Resources\ToolResource\Pages;

use App\Models\Owner;
use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\ToolResource;
use Filament\Notifications\Notification;
// use Illuminate\Notifications\Notification;
use App\Filament\Resources\OwnerResource;
use Doctrine\DBAL\Schema\Index;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Actions\Action;

class CreateTool extends CreateRecord
{
    
    protected static string $resource = ToolResource::class;

    // protected function handleRecordCreation(array $data): Model
    // {
    //     OwnerResource::getModel()::create([
    //         'email' => 'test@example.com',
    //         'name' => 'oliver',
    //         'phone' => 123,
    //     ]);
    //     return static::getModel()::create($data);
    // }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Tool Created')
            ->body('The tool has been created successfully.');
    }

    protected function beforeCreate(): void
{
    if (auth()->user()->id !== 1) {
        Notification::make()
            ->warning()
            ->title('You don\'t have an active subscription!')
            ->body('Choose a plan to continue.')
            ->persistent()
            ->actions([
                Action::make('subscribe')
                    ->button()
                    ->url(OwnerResource::getUrl('index'), shouldOpenInNewTab: true),
            ])
            ->send();
    
        $this->halt();
    }
}
}
