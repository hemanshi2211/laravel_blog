<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SmallCard extends Component
{

    public $num;
    public $title;
    public $color;
    public $icon;
    /**
     * Create a new component instance.
     */
    public function __construct($num,$title,$color,$icon)
    {
        $this->num = $num;
        $this->title = $title;
        $this->color = $color;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.small-card');
    }
}
