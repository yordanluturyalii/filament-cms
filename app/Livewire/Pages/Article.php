<?php

namespace App\Livewire\Pages;

use App\Models\Article as ModelsArticle;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Article extends Component
{
    public ModelsArticle $article;

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.pages.article');
    }
}
