<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public $showModal = true;

    public $file = '';

    public function render()
    {
        return view('livewire.upload');
    }

    public function save()
    {
        dd($this->file);
    }

    #[On('toggleModal')]
    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }
}
