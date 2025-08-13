<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HomeLayout extends Component
{
    public $css, $js, $menu, $title, $headerScrollEffect;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($menu = "", $title = null, $headerScrollEffect = false)
    {
        if ($headerScrollEffect == "true") $this->headerScrollEffect = true;
        else $this->headerScrollEffect = false;

        $this->menu = $menu;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.home');
    }
}
