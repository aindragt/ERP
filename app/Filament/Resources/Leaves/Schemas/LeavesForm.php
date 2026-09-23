<?php

namespace App\Filament\Resources\Leaves\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class LeavesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Leave Information')
                    ->icon(Heroicon::DocumentText)
                    ->description('Provide the details of the leave request.')
                    ->columns(2)
                    ->columnSpan(3)
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Employee')
                            ->searchable()
                            ->preload()
                            ->required(),
                            
                        Select::make('leave_type')
                            ->options([
                                'annual' => 'Annual Leave',
                                'sick' => 'Sick Leave',
                                'maternity' => 'Maternity Leave',
                                'unpaid' => 'Unpaid Leave',
                                'other' => 'Other',
                            ])
                            ->required()
                            ->native(false),
                            
                        DatePicker::make('start_date')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                            
                        DatePicker::make('end_date')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->afterOrEqual('start_date'), // Validasi agar tanggal selesai tidak lebih mundur dari tanggal mulai
                            
                        Textarea::make('reason')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Approval Status')
                    ->icon(Heroicon::CheckBadge)
                    ->description('Set the status of this request.')
                    ->columnSpan(1)
                    ->schema([
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->default('pending') // Sesuai dengan default di database
                            ->required()
                            ->native(false),
                    ]),
            ])->columns(4);
    }
}