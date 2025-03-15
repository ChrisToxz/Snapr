<?php

namespace App\Livewire;

use App\Models\Snap;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('snapUpdated')]
class SnapList extends Component
{
    public function render()
    {
        // TODO: Infinite loading
        return view('livewire.snap-list', ['snaps' => Snap::latest()->get()]);
    }

    public function delete(Snap $snap)
    {
        $snap->delete();
        $this->dispatch('snapUpdated');
    }

    public function edit(Snap $snap)
    {
        $this->dispatch('openEditModal', $snap->ident);
    }
}
