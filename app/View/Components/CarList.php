<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CarList extends Component
{
    public $cars;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cars)
    {
        $this->cars = $cars;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.car-list');
    }
}
