<?php

namespace App\Livewire;

use App\Settings\GeneralSettings;
use App\Settings\SnapSettings;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Settings extends Component
{
    use Toast;

    public bool $showDrawer = false;

    public array $settings = [
        'general' => [],
        'snap' => [],
    ];

    public function mount(GeneralSettings $generalSettings, SnapSettings $snapSettings)
    {
        $this->settings['general'] = $generalSettings->toArray();
        $this->settings['snap'] = $snapSettings->toArray();
    }

    #[On('toggleDrawer')]
    public function toggleDrawer()
    {
        $this->showDrawer = ! $this->showDrawer;
    }

    public function test(GeneralSettings $general, SnapSettings $snap)
    {
        foreach ($this->settings as $group => $settings) {
            foreach ($settings as $key => $value) {
                ds($group, $key, $value);
                $$group->$key = $value;
            }
            $$group->save();
        }
        $this->toggleDrawer();
        $this->success('Settings saved');
    }

    public function render(GeneralSettings $settings)
    {
        return view('livewire.settings', ['settings' => $this->settings]);
    }
}
