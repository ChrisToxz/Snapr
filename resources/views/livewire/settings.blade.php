<div>
    <!-- Drawer controlled by showDrawer1 -->
    <x-drawer wire:model="showDrawer" class="w-11/12 lg:w-1/3" right>
        <h1 class="text-xl">
            <x-icon name="o-cog-6-tooth" />
            Snapr settings
        </h1>
        <x-slot:actions class="float-left">
            <x-button label="Close" @click="$wire.showDrawer = false" />
            <x-button label="Confirm" class="btn-primary" icon="o-check" wire:click="test()" />
        </x-slot>
    </x-drawer>
</div>
