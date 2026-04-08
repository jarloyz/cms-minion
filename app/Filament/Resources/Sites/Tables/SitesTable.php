<?php

namespace App\Filament\Resources\Sites\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SitesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre_empresa')
                    ->label('Empresa')
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('URL')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('dominio')
                    ->label('Dominio')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('tema')
                    ->label('Tema')
                    ->badge(),
                TextColumn::make('telefono')
                    ->label('Telefono'),
                TextColumn::make('email')
                    ->label('Email')
                    ->toggleable(),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->since(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
