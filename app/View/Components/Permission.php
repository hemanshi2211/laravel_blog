<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role;

class Permission extends Component
{

    public $find;
    public $page;
    public $rolePermission;
    public function __construct($find,$page,$rolePermission = '')
    {
        $this->page = $page;
        $this->find = $find;
        $this->rolePermission = $rolePermission;
        // dd($rolePermission);
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $permission = ModelsPermission::all();
        return view('components.permission',compact('permission'));
    }
}
