<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('department_id')
                    ->required()
                    ->numeric(),
                TextInput::make('position_id')
                    ->required()
                    ->numeric(),
                TextInput::make('address'),
                TextInput::make('pob'),
                DatePicker::make('dob'),
                TextInput::make('gender'),
                TextInput::make('religion')
                    ->required(),
                TextInput::make('phone_number')
                    ->tel(),
                TextInput::make('salary')
                    ->required()
                    ->numeric()
                    ->default(0),
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),
                TextInput::make('status'),
            ]);
    }
}
