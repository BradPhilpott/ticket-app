<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SelectField extends Component
{
    public function __construct(public mixed $options)
    {

    }

    public function render(): View
    {
        return view('components.select-field');
    }
}