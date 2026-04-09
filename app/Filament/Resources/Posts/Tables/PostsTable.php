<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail'),
                TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->icon(fn (string $state): ?Heroicon => match ($state) {
                        'draft' => Heroicon::OutlinedPencilSquare,
                        'published' => Heroicon::OutlinedCheckCircle,
                        'archived' => Heroicon::OutlinedArchiveBox,
                        default => Heroicon::OutlinedQuestionMarkCircle,
                    }),
                IconColumn::make('is_featured')
                    ->label('Is Featured')
                    ->boolean(),
                TextColumn::make('category.name')
                    ->label('Category'),
                TextColumn::make('slug'),
                // TextColumn::make('content')->searchable(),
                // TextColumn::make('created_at')
                // ->label('Created At'),
            ])
            ->filters([

            ], layout: FiltersLayout::AboveContent)
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
