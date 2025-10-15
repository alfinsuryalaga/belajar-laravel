<?php

namespace App\Filament\Resources\PatientResource\Pages;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PatientResource;

class CreatePatient extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;
    protected static string $resource = PatientResource::class;

    protected function getSteps(): array
    {
        return [
            Step::make('name')
                ->description('Give a name to the patient')
                ->schema([
                    PatientResource::getNameFormField(),
                ]),
            Step::make('Date of Birth')
                ->description('Give the date of birth to the patient')
                ->schema([
                    PatientResource::getDateOfBirthFormField(),
                ]),
            Step::make('Type of Patient')
                ->description('Give the type of patient')
                ->schema([
                    PatientResource::getTypeFormField(),
                ]),
            Step::make('Owner Name')
                ->description('Give the owner name')
                ->schema([
                    PatientResource::getOwnerFormField(),
                ]),

        ];
    }
}

