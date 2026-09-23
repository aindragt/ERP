<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Department Information')
                ->icon(Heroicon::BuildingOffice2)
                ->description('Input about Department Information.')
                ->columns(2)
                ->columnSpan(3)
                ->schema([
                    TextInput::make('name')
                    ->required(),
                    TextInput::make('address'),
                    TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                    TextInput::make('phone_number')
                    ->tel(),
                    Textarea::make('description')
                    ->columnSpanFull()
                ])


                
            ]);
    }
}
