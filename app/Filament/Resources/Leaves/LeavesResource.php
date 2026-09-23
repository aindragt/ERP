<?php

namespace App\Filament\Resources\Leaves;

use App\Filament\Resources\Leaves\Pages\CreateLeaves;
use App\Filament\Resources\Leaves\Pages\EditLeaves;
use App\Filament\Resources\Leaves\Pages\ListLeaves;
use App\Filament\Resources\Leaves\Schemas\LeavesForm;
use App\Filament\Resources\Leaves\Tables\LeavesTable;
use App\Models\Leaves;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LeavesResource extends Resource
{
    protected static ?string $model = Leaves::class;

    protected static string|UnitEnum|null $navigationGroup = 'Human Resource Management';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'App\Model\Leaves';

    public static function form(Schema $schema): Schema
    {
        return LeavesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LeavesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLeaves::route('/'),
            'create' => CreateLeaves::route('/create'),
            'edit' => EditLeaves::route('/{record}/edit'),
        ];
    }
}
