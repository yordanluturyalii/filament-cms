<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Forms\Components\Slug;
use App\Models\Category;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use RalphJSmit\Filament\SEO\SEO;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make()->schema([
                    Tab::make('Content')->schema([
                        TextInput::make("title")->columnSpanFull()->required(),
                        Slug::make("slug")->columnSpanFull()->required(),
                        TiptapEditor::make('content')
                            ->columnSpanFull()
                            ->required(),
                        ColorPicker::make('text_color')->columnSpanFull(),
                        ColorPicker::make('background_color')->columnSpanFull(),
                        Toggle::make('is_tag')->columnSpanFull(),
                        Select::make('parent_id')->columnSpanFull()->relationship('parent', 'title')->searchable(),
                        Hidden::make('user_id')->dehydrateStateUsing(fn($state) => auth()->id()),
                    ]),
                    Tab::make("SEO")->schema([
                        SEO::make()
                    ]),
                    Tab::make('Media')->schema([
                        CuratorPicker::make('media_id')->name('Media')->required(),
                    ])
                ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make("media_id")->size(40),
                TextColumn::make('title')->label('Title')->searchable(),
                TextColumn::make('slug')->label('Slug')->searchable(),
                ColorColumn::make('text_color')->searchable(),
                ColorColumn::make('background_color')->searchable()
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
