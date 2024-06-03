<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    /**
     * Create a new component instance.
     */
    public $categoryName;

    public function __construct($categoryName = null)
    {
        $this->categoryName = $categoryName;
    }

    public function render()
    {
        return view('components.layout');
    }
}
