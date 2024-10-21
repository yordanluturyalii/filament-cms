<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Navbar extends Component
{
    public bool $responsiveMenu = false;

    public function toggleDrawer(): void {
        $this->responsiveMenu = !$this->responsiveMenu;
    }

    public function render()
    {
        return view('livewire.components.navbar');
    }
}
