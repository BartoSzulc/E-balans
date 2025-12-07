<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class Button extends Component
{
    public $href;
    public $text;

    public $target;
    public $variant;
    public $buttonClass;
    public $iconClass;
    public $wrapperClass;

    public function __construct($link = null, $text = 'Sprawdź', $target = '', $variant = 'default', $wrapperClass = '')
    {
        if (is_array($link) && isset($link['url'])) {
            $this->href = $link['url'];
            $this->text = $text;
            $this->target = $link['target'] ?? $target;
        } elseif (is_string($link)) {
            $this->href = $link;
            $this->text = $text;
            $this->target = $target;
        } else {
            $this->href = '/';
            $this->text = $text;
            $this->target = $target;
        }

        $this->variant = $variant;
        $this->wrapperClass = $wrapperClass;
        
        // Set button and icon classes based on variant
        $this->setVariantClasses();
    }

    public function render()
    {
        return $this->view('components.button');
    }

    protected function setVariantClasses()
    {
        switch ($this->variant) {
            case 'primary':
                $this->buttonClass = 'bg-color-2 hover:bg-color-2 text-color-1 black-chevron';
                $this->iconClass = 'bg-color-2';
                break;
            case 'purple': 
                $this->buttonClass = 'text-color-2 bg-color-2 hover:bg-color-2 hover:text-color-1';
                $this->iconClass = 'bg-purple900';
                break;
            case 'darkpurple':
                $this->buttonClass = 'text-purple200 bg-purple900 hover:bg-purple800 black-chevron';
                $this->iconClass = ' ';
                break;
            case 'default':
                $this->buttonClass = 'link-underline text-button text-color-2';
                $this->iconClass = 'hidden'; // Hide the icon for the default link style
                break;
            default:
                $this->buttonClass = 'link-underline text-button text-color-2'; // Same as default
                $this->iconClass = 'hidden';
                break;
        }
    }
}