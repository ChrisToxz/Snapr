<?php

namespace App\Livewire;

use App\Models\Snap;
use Livewire\Component;

class EditSnapModal extends Component
{
    public bool $editModal = false;

    public ?Snap $snap = null;

    public string $title = '';

    public string $description = '';

    protected $listeners = ['openEditModal'];

    public function openEditModal(Snap $snap)
    {
        $this->snap = $snap;
        $this->title = $snap->title;
        $this->description = $snap->description;
        $this->editModal = true;
    }

    public function updateSnap()
    {
        if ($this->snap) {
            $this->validate([
                'title' => 'required|min:3',
            ]);

            $this->snap->update([
                'title' => $this->title,
                'description' => $this->description,
            ]);

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
