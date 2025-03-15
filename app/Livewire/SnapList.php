<?php

namespace App\Livewire;

use App\Models\Snap;
use Livewire\Component;

class SnapList extends Component
{
    public bool $confirmModal = false;

    public string $confirmationTitle = '';

    public string $confirmationMessage = '';

    public string $confirmationMethod = '';

    public $confirmationParameter = null;

    public function render()
    {
        // TODO: Consider infinite scrolling or pagination here if needed.
        return view('livewire.snap-list', ['snaps' => Snap::latest()->get()]);
    }

    // Trigger the confirmation modal for deletion.
    public function confirmDelete(Snap $snap)
    {
        $this->confirmationTitle = 'Delete Snap';
        $this->confirmationMessage = "Are you sure you want to delete the snap titled \"{$snap->title}\"?";
        // We set the method that will be called on confirmation.
        $this->confirmationMethod = 'deleteSnap';
        // Store the snap's id (or the whole model if you prefer).
        $this->confirmationParameter = $snap->id;
        $this->confirmModal = true;
    }

    // Called when the Cancel button is clicked.
    public function cancelConfirmation()
    {
        $this->confirmModal = false;
    }

    // Called when the Confirm button is clicked.
    public function confirmAction()
    {
        if (method_exists($this, $this->confirmationMethod)) {
            $this->{$this->confirmationMethod}($this->confirmationParameter);
        }
        $this->confirmModal = false;
    }

    // Example deletion method.
    public function deleteSnap($snapId)
    {
        Snap::find($snapId)?->delete();
        // Dispatch an event or update your list as needed.
        $this->dispatch('snapUpdated');
    }
}
