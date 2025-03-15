<?php

namespace App\Livewire;

use App\Models\Snap;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

#[On('snapUpdated')]
class SnapList extends Component
{
    use Toast;

    public function render()
    {
        // TODO: Infinite loading
        return view('livewire.snap-list', ['snaps' => Snap::latest()->get()]);
    }

    public function delete(Snap $snap)
    {
        $snap->delete();
        $this->success('Snap deleted!');
        $this->dispatch('snapUpdated');
    }

    public function edit(Snap $snap)
    {

        $this->dispatch('openEditModal', $snap->ident);
    }
}
