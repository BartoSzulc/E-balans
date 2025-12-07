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
        $this->socials = $this->processSocials($socials);
    }
    protected function processSocials($socials)
    {
        return array_map(function ($social) {
            if (!empty($social['icon'])) {
                $url = $social['icon']['url'];
                $ext = pathinfo($url, PATHINFO_EXTENSION);
                $social['icon_type'] = $ext;
                $social['icon_content'] = $ext === 'svg' ? file_get_contents($url) : null;
            }
            return $social;
        }, $socials);
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.socials');
    }   
}