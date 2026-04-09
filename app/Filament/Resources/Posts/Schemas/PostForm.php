<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Enums\PostStatus;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->columnSpanFull()
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->copyable(),
                        Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->required()
                            ->native(false),
                        Select::make('tags')
                            ->label('Tags')
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                        MarkdownEditor::make('content')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('post-images')
                            ->required()
                            ->columnSpanFull(),
                    ])->columnSpan(4),
                Section::make()
                    ->schema([
                        FileUpload::make('thumbnail')
                            ->label('Tumbnail Image')
                            ->previewable(true)
                            ->directory('post-thumbnails')
                            ->visibility('public')
                            ->required(),
                        TextInput::make('author_name')
                            ->label('Author')
                            ->default(fn (): ?string => auth()->user()?->name)
                            ->disabled()
                            ->dehydrated(false),
                        Radio::make('status')
                            ->label('Choose Status')
                            ->options(PostStatus::getOptions())
                            ->default(PostStatus::DRAFT->value)
                            ->inline(false),
                        Toggle::make('is_featured')
                            ->label('Is Featured')
                            ->onIcon(Heroicon::Check)
                            ->offIcon(Heroicon::XMark),
                    ])->columnSpan(2),
            ])
            ->columns(6);
    }
}
