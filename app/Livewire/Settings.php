<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Settings extends Component
{
    use Toast;

    public bool $showDrawer = false;

    #[On('toggleDrawer')]
    public function toggleDrawer()
    {
        $this->showDrawer = ! $this->showDrawer;
    }

    public function test()
    {
        $this->toggleDrawer();
        $this->success('Settings saved');
    }

    public function render()
    {
        return view('livewire.settings');
    }
}
