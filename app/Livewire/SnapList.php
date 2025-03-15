<?php

namespace App\Livewire;

use App\Models\Snap;
use Livewire\Component;

class SnapList extends Component
{

    protected $listeners = ['snapUpdated' => '$refresh'];

    public function render()
    {
        return view('livewire.snap-list', ['snaps' => Snap::all()]);
    }

    public function edit(Snap $snap)
    {
        $this->dispatch('openEditModal', $snap->ident);
    }
}
