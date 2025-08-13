<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminLayout extends Component
{
    public $title, $ava, $menu;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($menu = "Halaman Admin", $title = null)
    {

        $this->menu = $menu;
        $this->title = $title ?? $menu;
        $this->ava = auth()->user()->profile_photo_url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.admin');
    }
}
