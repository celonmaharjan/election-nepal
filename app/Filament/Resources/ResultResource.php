<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResultResource\Pages;
use App\Filament\Resources\ResultResource\RelationManagers;
use App\Models\Result;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResultResource extends Resource
{
    protected static ?string $model = Result::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('candidate_id')
                    ->relationship('candidate', 'name')
                    ->required(),
                Forms\Components\Select::make('constituency_id')
                    ->relationship('constituency', 'name')
                    ->required(),
                Forms\Components\TextInput::make('votes_received')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('vote_percentage')
                    ->numeric(),
                Forms\Components\TextInput::make('rank')
                    ->numeric(),
                Forms\Components\Toggle::make('is_winner')
                    ->required(),
                Forms\Components\Toggle::make('is_published')
                    ->required(),
                Forms\Components\DateTimePicker::make('published_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('candidate.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('constituency.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('votes_received')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vote_percentage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rank')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_winner')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListResults::route('/'),
            'create' => Pages\CreateResult::route('/create'),
            'edit' => Pages\EditResult::route('/{record}/edit'),
        ];
    }
}
