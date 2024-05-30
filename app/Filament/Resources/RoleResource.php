<?php

namespace App\Filament\Resources;

use App\Enums\ApplicationRole;
use App\Enums\File\FilePermissions;
use App\Enums\Permissions\UserPermission;
use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Permission;
use App\Models\Role;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-finger-print';
    protected static ?string $navigationGroup = 'Configuraciones';
    protected static ?string $modelLabel = 'Rol';
    protected static ?string $pluralModelLabel = 'Roles';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        $data = $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nombre')
                    ->unique(ignoreRecord: true)
                    ->columnSpan(1),
                Group::make()
                    ->schema([
                        CheckboxList::make('user_permissions')
                            ->label('Permisos de usuarios')
                            ->columns(2)
                            ->relationship(
                                name: 'permissions',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn (Builder $query) => $query->where('name', 'like', UserPermission::Prefix . '%')
                            )
                            ->bulkToggleable()
                            ->getOptionLabelFromRecordUsing(fn ($record): string => UserPermission::tryFrom($record->name)?->getLabel() ?? $record->name),
                    ])
            ]);

        return $data;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('name')->label('Nombre')
                    ->formatStateUsing(fn (string $state): string => ApplicationRole::tryFrom($state)?->getLabel() ?? ucfirst($state)),
                TextColumn::make('created_at')->label('Fecha de creación')->dateTime('d-m-Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
