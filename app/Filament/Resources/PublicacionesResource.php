<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublicacionesResource\Pages;

use App\Filament\Resources\PublicacionesResource\RelationManagers;
use App\Models\Publicaciones;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PublicacionesResource extends Resource
{
    protected static ?string $model = Publicaciones::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->default(fn() => auth()->id()),

                Forms\Components\Textarea::make('descripcion')
                    ->label('Descripción')
                    ->required(),

                Forms\Components\FileUpload::make('media')
                    ->label('Fotos o videos')
                    ->multiple()
                    ->directory('publicaciones')
                    ->acceptedFileTypes(['image/*', 'video/*'])
                    ->maxFiles(5),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Usuario'),
                Tables\Columns\TextColumn::make('descripcion')->limit(50),
                Tables\Columns\ImageColumn::make('media.0')
                    ->label('Archivo')
                    ->disk('public') // o el disk que uses
                    ->circular(),
                Tables\Columns\TextColumn::make('created_at')->label('Fecha'),
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
            'index' => Pages\ListPublicaciones::route('/'),
            'create' => Pages\CreatePublicaciones::route('/create'),
            'edit' => Pages\EditPublicaciones::route('/{record}/edit'),
        ];
    }
}
