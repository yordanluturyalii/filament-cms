<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    public function save(bool $shouldRedirect = true, bool $shouldSendSavedNotification = true): void {
        parent::save($shouldRedirect, $shouldSendSavedNotification);
        Notification::make()->title('Article has been updated')->body('Your change has saved')->success()->send()->sendToDatabase(auth()->user());
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
