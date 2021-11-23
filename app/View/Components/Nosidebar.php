<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Nosidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $treeMenu;
    public $subMenu;
    public function __construct($treeMenu, $subMenu)
    {
        $this->treeMenu = $treeMenu;
        $this->subMenu = $subMenu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layout.nosidebar');
    }
}
