<?php

namespace App\Livewire;

use App\Actions\Snap\CreateSnap;
use App\Actions\Snap\GenerateSnapIdentifier;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

class Upload extends Component
{
    use Toast, WithFileUploads;

    public $showModal = false;

    #[Validate('required|image|max:4096')]
    public $file = '';

    public function render()
    {
        return view('livewire.upload');
    }

    // TODO: Transform CreateSnap action to also work with Livewire
    public function save()
    {
        $this->validate();
        auth()->user()->snaps()->create([
            'ident' => GenerateSnapIdentifier::run(),
            'title' => $this->file->getClientOriginalName(),
            'description' => '',
            'path' => $this->file->store(options: 'snaps'),
        ]);
        $this->dispatch('snapUpdated');
        $this->file = '';
        $this->toggleModal();
        $this->success('Snap uploaded!');
    }

    #[On('toggleModal')]
    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }
}
