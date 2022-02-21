<?php

namespace App\View\Components\Utils;

use Illuminate\View\Component;

class SimpleProgress extends Component
{
    public $percent;
    public $opacity;
    public $color;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($percent, $color = 'green')
    {
        $this->percent = intval($percent);
        $this->color = $color;
        $this->calculateOpacity();
    }

    public function calculateOpacity()
    {
        if ($this->percent >= 0 and $this->percent <= 25) {
            $this->opacity = '400';
        } elseif ($this->percent > 25 and $this->percent <= 50) {
            $this->opacity = '500';
        } elseif ($this->percent > 50 and $this->percent <= 54) {
            $this->opacity = '500';
        } elseif ($this->percent > 54 and $this->percent <= 75) {
            $this->opacity = '600';
        } else {
            $this->opacity = '700';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utils.simple-progress');
    }
}
