<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class catModal extends Component
{
    public $modalId;
    public $title;
    public $errorId;
    public $bName;
    public $bType;
    public $bClass;

    public function __construct($modalId,$title,$errorId,$bName,$bType,$bClass)
    {

        $this->modalId = $modalId;
        $this->title = $title;
        $this->errorId = $errorId;
        $this->bName = $bName;
        $this->bType = $bType;
        $this->bClass = $bClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cat-modal');
    }
}
