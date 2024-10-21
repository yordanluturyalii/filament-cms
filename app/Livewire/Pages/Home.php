<?php

namespace App\Livewire\Pages;

use App\Models\Article;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.home', [
            'articles' => Article::isPublished()->with(['user', 'image'])->paginate(9),
        ]);
    }
}
