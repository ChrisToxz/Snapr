{{-- resources/views/components/confirmation-modal.blade.php --}}

@props([
    // The property bound to the parent’s Livewire boolean that toggles modal visibility.
    "wireModel" => "confirmModal",
    // Modal title and message.
    "title" => "Confirm",
    "message" => "Are you sure?",
    // Methods defined in the parent to call on cancel/confirm.
    "cancelMethod" => "cancelConfirmation",
    "confirmMethod" => "confirmAction",
    // Label for the confirmation button.
    "confirmLabel" => "Confirm",
])

<x-modal wire:model="{{ $wireModel }}" title="{{ $title }}" class="backdrop-blur" box-class="bg-base-200 rounded-md">
    <div class="p-4">
        {{ $message }}
    </div>
    <x-slot:actions>
        <x-button label="Cancel" wire:click="{{ $cancelMethod }}" />
        <x-button
            label="{{ $confirmLabel }}"
            class="btn btn-danger"
            wire:click="{{ $confirmMethod }}"
            spinner="confirm"
        />
    </x-slot>
</x-modal>
