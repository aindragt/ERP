<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Company Information')
                    ->icon(Heroicon::BuildingOffice2)
                    ->description('Please provide the company information.')
                    ->columns(2)
                    ->columnSpan(3)
                    ->schema([
                        TextInput::make('name')
                        ->columnSpanFull()
                        ->required(),
                        Textarea::make('address')
                        ->columnSpanFull()
                        ->required(),
                        TextInput::make('email')
                        ->label('Email address')
                        ->email()
                        ->required(),
                        TextInput::make('phone_number')
                        ->tel()
                        ->required(),
                    ]),

                Section::make('Company Logo')
                    ->columnSpan(1)
                    ->description('Upload the company logo.')
                    ->schema([
                        FileUpload::make('logo')
                            ->image()
                            ->disk('public')
                            ->directory('logos')
                            ->visibility('public'),
                    ]),
            ])->columns(4);
    }
}
