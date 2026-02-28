<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CandidateResource\Pages;
use App\Filament\Resources\CandidateResource\RelationManagers;
use App\Models\Candidate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CandidateResource extends Resource
{
    protected static ?string $model = Candidate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('name_nepali'),
                Forms\Components\TextInput::make('photo'),
                Forms\Components\Select::make('party_id')
                    ->relationship('party', 'name'),
                Forms\Components\Select::make('constituency_id')
                    ->relationship('constituency', 'name')
                    ->required(),
                Forms\Components\TextInput::make('age')
                    ->numeric(),
                Forms\Components\TextInput::make('gender'),
                Forms\Components\TextInput::make('education_level'),
                Forms\Components\Textarea::make('education_details')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('occupation'),
                Forms\Components\TextInput::make('address'),
                Forms\Components\TextInput::make('criminal_cases')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Textarea::make('assets_declared')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('manifesto_summary')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('detailed_manifesto')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('social_links')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('website'),
                Forms\Components\Textarea::make('previous_election_result')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_incumbent')
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name_nepali')
                    ->searchable(),
                Tables\Columns\TextColumn::make('photo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('party.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('constituency.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('age')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('education_level')
                    ->searchable(),
                Tables\Columns\TextColumn::make('occupation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('criminal_cases')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_incumbent')
                    ->boolean(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
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
            'index' => Pages\ListCandidates::route('/'),
            'create' => Pages\CreateCandidate::route('/create'),
            'edit' => Pages\EditCandidate::route('/{record}/edit'),
        ];
    }
}
