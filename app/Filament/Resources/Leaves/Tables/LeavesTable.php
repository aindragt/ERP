<?php

namespace App\Filament\Resources\Leaves\Tables;

// use Filament\Tables\Actions\BulkActionGroup;
// use Filament\Tables\Actions\DeleteAction;
// use Filament\Tables\Actions\DeleteBulkAction;
// use Filament\Tables\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LeavesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Employee')
                    ->sortable()
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('leave_type')
                    ->label('Type')
                    ->badge()
                    ->color('info') // Warna biru muda
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'annual' => 'Annual Leave',
                        'sick' => 'Sick Leave',
                        'maternity' => 'Maternity Leave',
                        'unpaid' => 'Unpaid Leave',
                        'other' => 'Other',
                        default => ucfirst($state),
                    }),

                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('End Date')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('reason')
                    ->label('Reason')
                    ->limit(30) // Membatasi panjang teks agar tabel tidak melebar berantakan
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning', // Kuning/Orange
                        'approved' => 'success', // Hijau
                        'rejected' => 'danger', // Merah
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
                
                SelectFilter::make('leave_type')
                    ->options([
                        'annual' => 'Annual Leave',
                        'sick' => 'Sick Leave',
                        'maternity' => 'Maternity Leave',
                        'unpaid' => 'Unpaid Leave',
                        'other' => 'Other',
                    ]),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}