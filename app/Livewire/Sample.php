<?php

namespace App\Livewire;

use Livewire\Component;

class Sample extends Component
{
    public $helloWorld = 'Hello, World!';
    public function render()
    {
        return view('livewire.sample');
    }
}
