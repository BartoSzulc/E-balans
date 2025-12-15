<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Socials extends Component

{

    public $socials;

    /**
     * Create a new component instance.
     */
    public function __construct($socials = [])
    {
        // No processing needed - icon is now a Font Awesome icon name string
        $this->socials = $socials;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.socials');
    }   
}