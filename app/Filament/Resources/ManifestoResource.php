<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ManifestoResource\Pages;
use App\Filament\Resources\ManifestoResource\RelationManagers;
use App\Models\Manifesto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManifestoResource extends Resource
{
    protected static ?string $model = Manifesto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('party_id')
                    ->relationship('party', 'name')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Textarea::make('summary')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('full_text')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('published_date'),
                Forms\Components\TextInput::make('pdf_url'),
                Forms\Components\Textarea::make('key_points')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('party.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pdf_url')
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
            'index' => Pages\ListManifestos::route('/'),
            'create' => Pages\CreateManifesto::route('/create'),
            'edit' => Pages\EditManifesto::route('/{record}/edit'),
        ];
    }
}
