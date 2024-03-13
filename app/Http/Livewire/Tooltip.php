<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Tooltip extends Component
{
    public $tooltipColor = "alert-error";
    public array $errorsData = [];
    public function mount($errors, $tooltipColor = "alert-error"){
        array_push($this->errorsData, $errors);
        $this->tooltipColor = $tooltipColor;
    }
    public function render()
    {
        return view('livewire.tooltip');
    }
}
