<div class="card bg-base-200 shadow-xl">
    <div class="card-body">
        <h2 class="card-title">{{ $snap->name }}</h2>
        <p>{{ $snap->description }}</p>
        <div class="flex justify-end gap-2 mt-4">
            <x-popover position="top">
                <x-slot:trigger>
                    <x-icon name="o-eye" class="text-gray-500 hover:text-gray-700 cursor-pointer transition-colors duration-300" />
                </x-slot:trigger>
                <x-slot:content>
                    View
                </x-slot:content>
            </x-popover>
            <x-popover position="top">
                <x-slot:trigger>
                    <x-icon name="o-pencil" class="text-blue-500 hover:text-blue-700 cursor-pointer transition-colors duration-300" wire:click="edit('{{$snap->ident}}')" />
                </x-slot:trigger>
                <x-slot:content>
                    Edit
                </x-slot:content>
            </x-popover>
            <x-popover position="top">
                <x-slot:trigger>
                    <x-icon name="o-trash" class="text-red-500 hover:text-red-700 cursor-pointer transition-colors duration-300" />
                </x-slot:trigger>
                <x-slot:content>
                    Delete
                </x-slot:content>
            </x-popover>
        </div>
    </div>
</div>
