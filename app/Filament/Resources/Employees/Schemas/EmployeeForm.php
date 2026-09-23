<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Information')
                    ->icon(Heroicon::Users)
                    ->columnSpan(2)
                    ->schema([
                        Group::make()
                            ->relationship('user')
                            ->schema([
                                TextInput::make('name')
                                    ->placeholder('Name')
                                    ->required(),
                                TextInput::make('email')
                                    ->placeholder('Email Address')
                                    ->label('Email Address')
                                    ->required(),
                                TextInput::make('password')
                                    ->placeholder('Password')
                                    ->password()
                                    ->required(fn(string $operation):bool => $operation === 'create')
                                    ->dehydrated(fn (?string $state): bool => filled($state)),
                            ])
                    ]),


                Section::make('Profile Picture')
                    ->icon(Heroicon::Camera)
                    ->columnSpan(1)
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('employees')
                    ]),


                Section::make('Personal Information')
                    ->icon(Heroicon::UserPlus)
                    ->columns(3)
                    ->columnSpan('full')
                    ->schema([
                        TextInput::make('pob')
                            ->columnSpan(2)
                            ->placeholder('Place of Birth')
                            ->label('Place of Birth'),
                        DatePicker::make('dob')
                            ->label('Date of Birth')
                            ->default('1990/01/01'),
                        Textarea::make('address')
                            ->placeholder('Address')
                            ->rows(3)
                            ->extraInputAttributes(['style' => 'resize:none'])
                            ->columnSpanFull(),
                        Select::make('gender')
                            ->options([
                                'male'      => 'Male',
                                'female'    => 'Female'
                            ]),
                        Select::make('religion')
                            ->options([
                                'islam'     => 'Islam',
                                'katolik'   => 'Katolik',
                                'protestan' => 'Protestan',
                                'hindu'     => 'Hindu',
                                'buddha'    => 'Buddha',
                                'konghucu'  => 'Konghucu'
                            ]),
                        TextInput::make('phone_number')
                            ->label('Phone Number')
                            ->placeholder('Phone Number')
                            ->tel()
                    ]),


                Section::make('Job Information')
                    ->icon(Heroicon::Briefcase)
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        Select::make('department_id')
                            ->relationship('department', 'name'),
                        Select::make('position_id')
                            ->relationship('position', 'name'),
                        TextInput::make('salary')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Select::make('status')
                            ->options([
                                'applicant' => 'Applicant',
                                'trainee'   => 'Trainee',
                                'active'    => 'Active',
                                'inactive'  => 'Inactive'
                            ]),
                        DatePicker::make('start_date'),
                        DatePicker::make('end_date'),
                    ]),
            ])->columns(3);
    }
}