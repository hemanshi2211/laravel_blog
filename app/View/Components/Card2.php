<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card2 extends Component
{

    public $color;
    public $icon;
    public $title;
    public $num;
    public $des;

    public function __construct($color,$icon,$num,$title,$des)
    {
        $this->color = $color;
        $this->icon = $icon;
        $this->title = $title;
        $this->num = $num;
        $this->des = $des;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card2');
    }
}
