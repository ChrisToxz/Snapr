<?php

namespace App\Livewire;

use App\Models\Snap;
use Livewire\Component;

class EditSnapModal extends Component
{
    public bool $editModal = false;
    public ?Snap $snap = null;
    public string $name = '';

    protected $listeners = ['openEditModal'];

    public function openEditModal(Snap $snap)
    {
        $this->snap = $snap;
        $this->name = $snap->name;
        $this->editModal = true;
    }

    public function updateSnap()
    {
        if ($this->snap) {
            $this->validate([
                'name' => 'required|min:3',
            ]);

            $this->snap->update(['name' => $this->name]);

            $this->dispatch('snapUpdated');
            $this->closeModal();
        }
    }

    public function closeModal()
    {
        $this->editModal = false;
    }

    public function render()
    {
        return view('livewire.edit-snap-modal');
    }
}
