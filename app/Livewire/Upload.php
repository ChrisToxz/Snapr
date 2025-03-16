<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public $showModal = true;

    #[Validate('required|image|max:4096')]
    public $file = '';

    public function render()
    {
        return view('livewire.upload');
    }

    public function save()
    {
        dd($this->validate());

    }

    #[On('toggleModal')]
    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }
}
