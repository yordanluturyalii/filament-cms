<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;
use Illuminate\Support\Str;

class Slug extends Field
{
    protected string $view = 'forms.components.slug';

    public function getValue(): string {
        $value = parent::getvalue();

        return Str::slug($value);
    }
}
