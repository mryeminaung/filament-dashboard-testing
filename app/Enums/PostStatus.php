<?php

namespace App\Enums;

enum PostStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';

    public static function getOptions(): array
    {
        return collect(self::cases())->mapWithKeys(function ($case) {
            return [$case->value => ucfirst($case->value)];
        })->toArray();
    }
}
