<?php

namespace App\Filament\Resources\ForumReplies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ForumReplyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('topic_id')
                    ->required()
                    ->numeric(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('parent_id')
                    ->numeric()
                    ->default(null),
                Textarea::make('isi')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
