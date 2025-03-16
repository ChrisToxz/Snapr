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

    public int $loadedSnaps = 3;

    public function render()
    {
        return view('livewire.snap-list', ['snaps' => Snap::latest()->take($this->loadedSnaps)->get()]);
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

    public bool $endOfSnaps = false;

    public function loadMore(): void
    {
        $totalSnaps = Snap::count();

        if ($this->loadedSnaps < $totalSnaps) {
            $this->loadedSnaps += 3;
        }

        if ($this->loadedSnaps >= $totalSnaps) {
            $this->dispatch('end-of-snaps');
        }
    }
}
