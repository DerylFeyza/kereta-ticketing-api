<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PelangganForm extends Component
{
    public $action;
    public $method;
    public $pelanggan;

    public function __construct($action, $method = 'POST', $pelanggan = null)
    {
        $this->action = $action;
        $this->method = $method;
        $this->pelanggan = $pelanggan;
    }

    public function render(): View|Closure|string
    {
        return view('components.pelanggan-form');
    }
}
