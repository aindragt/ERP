<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Employment Details')
                    ->icon(Heroicon::Briefcase)
                    ->description('Manage employee roles, relationships, and status.')
                    ->columns(2)
                    ->columnSpan(3)
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('department_id')
                            ->relationship('department', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('position_id')
                            ->relationship('position', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('salary')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),
                        DatePicker::make('start_date')
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                        DatePicker::make('end_date')
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                        Select::make('status')
                            ->options([
                                'applicant' => 'Applicant',
                                'active' => 'Active',
                                'trainee' => 'Trainee',
                                'x' => 'Not Active / Resigned',
                            ])
                            ->native(false),
                    ]),

                Section::make('Profile Picture')
                    ->columnSpan(1)
                    ->description('Upload employee image.')
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->disk('public')
                            ->directory('employees')
                            ->visibility('public'),
                    ]),

                Section::make('Personal Information')
                    ->icon(Heroicon::User)
                    ->description('Employee detailed personal information.')
                    ->columns(2)
                    ->columnSpan(4)
                    ->schema([
                        TextInput::make('pob')
                            ->label('Place of Birth'),
                        DatePicker::make('dob')
                            ->label('Date of Birth')
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                        Select::make('gender')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                            ])
                            ->native(false),
                        Select::make('religion')
                            ->required()
                            ->options([
                                'islam' => 'Islam',
                                'katolik' => 'Katolik',
                                'protestan' => 'Protestan',
                                'hindu' => 'Hindu',
                                'budha' => 'Budha',
                                'konghucu' => 'Konghucu',
                            ])
                            ->native(false),
                        TextInput::make('phone_number')
                            ->tel(),
                        Textarea::make('address')
                            ->columnSpanFull(),
                    ]),
            ])->columns(4);
    }
}