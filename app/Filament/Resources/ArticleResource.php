<?php

namespace App\Filament\Resources;

use App\Enum\ArticleStatus;
use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Forms\Components\Slug;
use App\Models\Article;
use App\Models\Category;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use RalphJSmit\Filament\SEO\SEO;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make()->schema([
                    Tab::make('Content')->schema([
                        TextInput::make("title")->columnSpanFull()->required(),
                        TextInput::make("slug")->columnSpanFull()->required(),
                        TiptapEditor::make('content')
                            ->columnSpanFull()
                            ->required(),
                        Select::make('categories')->multiple()->relationship('categories', 'title')->searchable()->columnSpanFull(),
                        Hidden::make('user_id')->dehydrateStateUsing(fn($state) => auth()->id()),
                        Select::make('status')->options(options: [
                            'Draft' => 'Draft',
                            'Published' => 'Published'
                        ])
                    ]),
                    Tab::make('SEO')->schema([
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
                TextColumn::make("title")->searchable(),
                TextColumn::make("slug")->searchable(),
                SelectColumn::make('status')->options([
                    'Published' => 'Published',
                    'Draft' => 'Draft'
                ])->searchable(),
                TextColumn::make('categories.title')->badge()->searchable(),
            ])
            ->filters([
                SelectFilter::make('categories')->multiple()->relationship('categories', 'title')->searchable(),
                TrashedFilter::make(),
                SelectFilter::make('status')->options(options: [
                    'Draft' => 'Draft',
                    'Published' => 'Published'
                ]),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
