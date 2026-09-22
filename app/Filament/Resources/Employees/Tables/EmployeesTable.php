<?php

namespace App\Filament\Resources\Employees\Tables;

// use Filament\Tables\Actions\BulkActionGroup;
// use Filament\Tables\Actions\DeleteAction;
// use Filament\Tables\Actions\DeleteBulkAction;
// use Filament\Tables\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('image')
                    ->label('Profile Picture')
                    ->disk('public')
                    ->visibility('public'),
                    // ->circular() // Mengubah gambar menjadi bulat (avatar)
                    // ->defaultImageUrl(url('/images/default-avatar.png')), // Opsional jika gambar kosong

                TextColumn::make('user.name')
                    ->label('Name')
                    ->sortable()
                    ->searchable()
                    ->weight('bold'), // Ditebalkan agar nama lebih menonjol

                TextColumn::make('user.email')
                    ->label('Email')
                    ->sortable()
                    ->searchable()
                    ->copyable() // Memudahkan user untuk klik & copy email
                    ->copyMessage('Email copied')
                    ->icon('heroicon-m-envelope'),

                TextColumn::make('department.name')
                    ->label('Department')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('position.name') // Memanggil nama posisi dari relasi
                    ->label('Position')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('phone_number')
                    ->label('Phone Number')
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge() // Membuat tampilan status menjadi kotak berwarna
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success', // Hijau
                        'trainee' => 'warning', // Kuning
                        'applicant' => 'info', // Biru
                        'x' => 'danger', // Merah
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'applicant' => 'Applicant',
                        'active' => 'Active',
                        'trainee' => 'Trainee',
                        'x' => 'Not Active / Resigned', // Mengubah label 'x'
                        default => ucfirst($state),
                    }),
            ])
            ->filters([
                // Filter dropdown berdasarkan Status
                SelectFilter::make('status')
                    ->options([
                        'applicant' => 'Applicant',
                        'active' => 'Active',
                        'trainee' => 'Trainee',
                        'x' => 'Not Active / Resigned',
                    ]),
                
                // Filter dropdown berdasarkan Department
                SelectFilter::make('department_id')
                    ->relationship('department', 'name')
                    ->label('Department'),
            ])
            ->actions([ // Method di Filament v3 yang disarankan
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([ // Method di Filament v3 yang disarankan
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}