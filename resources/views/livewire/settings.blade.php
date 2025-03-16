<div>
    <x-drawer icon="o-cog-6-tooth" wire:model="showDrawer" class="w-11/12 lg:w-1/3" right>
        <x-slot:title>Snapr settings</x-slot>
        <x-form>
            <x-input wire:model="settings.general.site_name" label="Site name" />
            <x-toggle
                label="Watermark"
                wire:model="settings.snap.setWatermark"
                hint="Set watermark on uploaded images"
            />
            <x-slot:actions class="float-left">
                <x-button label="Close" @click="$wire.showDrawer = false" />
                <x-button label="Confirm" class="btn-primary" icon="o-check" wire:click="test()" />
            </x-slot>
        </x-form>
    </x-drawer>
</div>
