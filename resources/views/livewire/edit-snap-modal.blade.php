<x-modal wire:model="editModal" title="Edit Snap" class="backdrop-blur" box-class="bg-base-200 rounded-md">
    @if ($snap)
        <x-form wire:submit="updateSnap">
            <x-input label="Title" wire:model="title" class="w-full" />
            <x-input label="Description" wire:model="description" class="w-full" />

            <x-slot:actions>
                <x-button label="Cancel" wire:click="closeModal" />
                <x-button label="Save" class="btn btn-soft" type="submit" spinner="save" />
            </x-slot>
        </x-form>
    @else
        <p>No snap selected.</p>
    @endif
</x-modal>
